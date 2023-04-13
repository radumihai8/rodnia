<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public const HOME = '/';
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
        Paginator::useBootstrapFive();

        Gate::define('admin', function (Account $user) {
            return $user->web_admin >= 9;
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });

        view()->composer('layouts.shop', function($view) {
            $view->with(['categories' => Category::all()]);
        });
    }
}
