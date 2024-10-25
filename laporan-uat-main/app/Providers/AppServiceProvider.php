<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Illuminate\Database\Events;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function logWhenInConsole(): void
    {
        $logger = Log::getLogger();
        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $logger->pushHandler(new StreamHandler("php://stdout"));

        Event::listen(function (Events\QueryExecuted $event) {
            // skip jika tidak didebug. diskip disini karena flag debug bisa dihidupkan
            // setelah boot selesai
            if (!config('app.debug')) {
                return;
            }
            // Format binding data for sql insertion
            $bindings = [];
            foreach ($event->bindings as $binding) {
                if (is_object($binding)) {
                    $bindings[] = "'$binding'";
                } else {
                    $bindings[] = var_export($binding, true);
                }
            }

            // Insert bindings into query
            $query = str_replace(['%', '?'], ['%%', '%s'], $event->sql);
            $query = vsprintf($query, $bindings);

            Log::debug("$event->connectionName - $query");
        });

        Event::listen(function (Events\TransactionBeginning $event) {
            Log::debug("$event->connectionName - begin");
        });

        Event::listen(function (Events\TransactionCommitted $event) {
            Log::debug("$event->connectionName - committed");
        });

        Event::listen(function (Events\TransactionCommitting $event) {
            Log::debug("$event->connectionName - committing");
        });

        Event::listen(function (Events\TransactionRolledBack $event) {
            Log::debug("$event->connectionName - rollback");
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (App::runningInConsole()) {
            $this->logWhenInConsole();
        }

        Model::shouldBeStrict(App::runningUnitTests());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
