<?php

namespace WebAppId\Region;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use WebAppId\Region\Commands\SeedCommand;
use WebAppId\Region\Services\RegionService;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind('region', function () {
            return new RegionService(new Container());
        });
        $this->commands(SeedCommand::class);
    }
    public function boot()
    {
        if ($this->isLaravel53AndUp()) {
            $this->loadMigrationsFrom(__DIR__ . '/migrations');
        } else {
            $this->publishes([
                __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations',
            ], 'migrations');
        }
    }
    protected function isLaravel53AndUp()
    {
        return version_compare($this->app->version(), '5.3.0', '>=');
    }
}
