<?php

namespace Harishariyanto\Sitemap;

use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../publishes/app'       => app_path(),
            __DIR__ . '/../publishes/views'     => resource_path('views')
        ]);
    }
}
