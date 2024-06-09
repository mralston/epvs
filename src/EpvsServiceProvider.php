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

            $this->publishes([
                __DIR__ . '/../database/migrations/create_epvs_finance_brokers_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_finance_brokers_table.php'),
                __DIR__ . '/../database/migrations/create_epvs_finance_lenders_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_finance_lenders_table.php'),
                __DIR__ . '/../database/migrations/create_epvs_installers_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_installers_table.php'),
                __DIR__ . '/../database/migrations/create_epvs_insurance_providers_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_insurance_providers_table.php'),
                __DIR__ . '/../database/migrations/create_epvs_product_types_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_product_types_table.php'),
                __DIR__ . '/../database/migrations/create_epvs_users_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_users_table.php'),
                __DIR__ . '/../database/migrations/create_epvs_validation_statuses_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_validation_statuses_table.php'),
                __DIR__ . '/../database/migrations/create_epvs_validations_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_epvs_validations_table.php'),
            ], 'epvs-migrations');

            $this->commands([
                GetWebhookUrls::class,
                CheckStatus::class,
            ]);
        }
    }
}
