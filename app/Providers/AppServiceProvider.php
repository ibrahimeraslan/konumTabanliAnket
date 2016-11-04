<?php

namespace App\Providers;

use App\page\SistemSayfa;
use App\page\Sss;
use App\SistemAyar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            $view->with('ayarlar', SistemAyar::all()->first());
            $view->with('sayfalar', SistemSayfa::all());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
