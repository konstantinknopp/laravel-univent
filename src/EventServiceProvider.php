<?php

namespace Unikat\Univent;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap any application services
     */
    public function boot()
    {
        /**
         * Adds a directive in Blade for actions
         */
        Blade::directive('action', function($expression) {
            return "<?php Univent::action$expression; ?>";
        });
    }
    
    /**
     * Registers the singleton
     */
    public function register()
    {
        $this->app->singleton('univent', function ($app) {
            return new Events();
        });
    }
}
