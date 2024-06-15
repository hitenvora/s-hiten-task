<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Adapter\Local;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;

class ImageFactoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Server::class, function ($app) {
            $filesystem = new \League\Flysystem\Filesystem(new Local(
                storage_path('app/')
            ));
            return ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $filesystem,
                'cache' => $filesystem,
                'cache_path_prefix' => '.cache',
                'base_url' => 'img',
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
