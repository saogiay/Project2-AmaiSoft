<?php

namespace App\Providers;

use App\Http\View\Composers\ColorComposer;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\SizeComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('user.layouts.navbar', MenuComposer::class);
        View::composer('user.category', SizeComposer::class);
        View::composer('user.category', ColorComposer::class);
    }
}
