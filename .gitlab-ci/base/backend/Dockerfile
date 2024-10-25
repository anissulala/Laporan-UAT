FROM dhub.dev.siap.id/centos:7.8.2003

RUN yum-config-manager \
        --add-repo=https://yum.dev.siap.id/lely.repo \
    && yum install -y \
        https://yum.dev.siap.id/jpel/7/x86_64/Packages/epel-release-jagr-dev-latest-7.noarch.rpm \
        https://yum.dev.siap.id/jpel/7/x86_64/Packages/remi-release-jagr-dev-latest-7.noarch.rpm \
    && yum-config-manager --disable base epel extras updates jpel-test \
    && yum-config-manager --enable remi-php83 \
    && yum update ca-certificates -y \
    && sed -ri \
        -e 's!override_install_langs=en_US.utf8!override_install_langs=en_US,id_ID!g' \
        /etc/yum.conf \
    && ( yum update -y glibc-common || yum reinstall -y glibc-common ) \
    && yum install -y \
        php \
        php-bcmath \
        php-gd \
        php-mbstring \
        php-mcrypt \
        php-mysqlnd \
        php-opcache \
        php-pecl-memcached \
        php-pecl-zip \
        php-xml \
        unzip \
    && rm -rf \
        /var/cache/yum \
        /var/tmp/yum-*

EXPOSE 80/tcp
CMD ["/usr/sbin/httpd", "-DFOREGROUND"]

COPY --chown=root:root files/ /
