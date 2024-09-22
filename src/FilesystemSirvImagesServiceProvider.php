<?php

namespace Lipit146\FilesystemSirv;

use Lipit146\FilesystemSirv\SirvImagesAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class FilesystemSirvImagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfigs();
        }

        Storage::extend('sirv', function ($app, $config) {
            return new SirvImagesAdapter($config);
        });
    }

    public function register(): void
    {
        $this->registerConfig();
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/sirv.php', 'sirv');
    }

    protected function publishConfigs()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/config/sirv.php' => config_path('sirv.php')], 'config');
        }
    }
}
