<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
            $this->app['url']->forceRootUrl(config('app.url'));
        }
    
        if (config('app.env') !== 'local') {
            $this->app['url']->forceScheme('https');
        }
        
        if (config('app.debug') === false) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
