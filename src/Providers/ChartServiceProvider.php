<?php

namespace Vitoutry\Charts\Providers;

use Illuminate\Support\ServiceProvider;

class ChartServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/charts.php', 'vitoutry.charts');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chart-template');
        $this->publishes([
            __DIR__.'/../config' => config_path('vitoutry'),
        ], ['charts-config', 'vitoutry-config']);
    }

//    /**
//     * Array with colours configuration of the chartjs config file
//     * @var array
//     */
//    protected $colours = [];
//
//    public function boot()
//    {
//
//        $this->colours = config('chartjs.colours');
//    }


    // /**
    //  * Register the service provider.
    //  *
    //  * @return void
    //  */
    // public function register()
    // {
    //     $this->app->bind('chartjs', function() {
    //         return new Builder();
    //     });
    // }

}
