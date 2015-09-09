<?php

/**
 * Bridge between zizaco/entrust and Doctrine2
 *
 * @license MIT
 * @package SpotOnLive\EntrustDoctrineORM
 */

namespace SpotOnLive\EntrustDoctrineORM;

use Illuminate\Support\ServiceProvider;

class EntrustDoctrineORMServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make('SpotOnLive\EntrustDoctrineORM\EntrustDoctrineORM');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('sl-entrust-doctrine-orm', function ($app) {
            return new EntrustDoctrineORM($app);
        });

        $this->app->alias('sl-entrust-doctrine-orm', 'SpotOnLive\EntrustDoctrineORM\EntrustDoctrineORM');
    }
}