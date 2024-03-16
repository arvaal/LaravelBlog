<?php

namespace App\Providers;

use App\Http\Controllers\Common\NavigationBarController;
use App\Http\Controllers\Common\SidebarController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function($view) {
            $data['bar'] = NavigationBarController::get();
            $data['search'] = route('blog.search');
            $view->with('navigation_bar', $data);
        });

        View::composer(['account/posts','account/post','account/settings','account/home'], function ($view){
            $data['aside_left'] = SidebarController::getAsideLeft();
            $view->with('asides', $data);
        });
    }
}
