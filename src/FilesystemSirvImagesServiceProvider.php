<?php

namespace Lipit146\FilesystemSirv;

use Lipit146\FilesystemSirv\SirvImagesAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class FilesystemSirvImagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/sirv.php' => config_path('sirv.php'),
        ], 'config');

        Storage::extend('sirv', function ($app, $config) {
            return new SirvImagesAdapter($config);
        });
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        //
    }
}
