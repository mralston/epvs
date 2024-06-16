<?php

namespace Mralston\Epvs;

use Illuminate\Support\ServiceProvider;
use Mralston\Epvs\ApiClient;
use Mralston\Epvs\Console\Commands\CheckStatus;
use Mralston\Epvs\Console\Commands\GetWebhookUrls;

class EpvsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'epvs');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('epvs', function ($app) {
            return new ApiClient(
                config('epvs.token'),
                config('epvs.endpoint')
            );
        });

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('epvs.php'),
            ], 'epvs-config');

            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->commands([
                GetWebhookUrls::class,
                CheckStatus::class,
            ]);
        }
    }
}
