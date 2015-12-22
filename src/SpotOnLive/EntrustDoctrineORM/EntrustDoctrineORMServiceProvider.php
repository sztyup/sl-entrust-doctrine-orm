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

        // Support for laravel-doctrine/orm
        if (class_exists('\LaravelDoctrine\ORM\DoctrineManager')) {
            $this->app->make('\LaravelDoctrine\ORM\DoctrineManager')->addPaths([
                __DIR__ . DIRECTORY_SEPARATOR,
            ]);
        }
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