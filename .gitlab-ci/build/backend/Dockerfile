ARG PREBUILD_HUB
ARG IMAGE_NAMESPACE
ARG STAGE

FROM ${PREBUILD_HUB}/${IMAGE_NAMESPACE}/base-laporan-uat-${STAGE}:latest

ARG DOMAIN
ARG STAGE
ARG MEMCACHED

RUN \
    # setup httpd
    sed -ri \
        -e "s!ServerAdmin root@localhost!ServerAdmin admin@${DOMAIN}!g" \
        -e "s!#ServerName www.example.com:80!ServerName ${DOMAIN}:80!g" \
        /etc/httpd/conf/httpd.conf ; \
    # setup php
    sed -ri \
        # set session handler
        -e 's!session.save_handler = files!session.save_handler = memcached!g' \
        -e "s!;session.save_path = \"/tmp\"!session.save_path = \"${MEMCACHED}\"!g" \
        /etc/php.ini ; \
    # batasi 1 worker untuk devel
    if [[ ${STAGE} == devel ]] ; then \
            sed -ri \
                -e '$a\\ \
\n\
\# Extra options \n\
StartServers 1 \n\
MinSpareServers 1 \n\
MaxSpareServers 2' \
                /etc/httpd/conf/httpd.conf ; \
        fi

WORKDIR /var/www/html
COPY --chown=root:root . .

RUN chown -R apache:apache storage bootstrap
