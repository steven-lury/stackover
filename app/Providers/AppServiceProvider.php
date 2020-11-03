<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
//use Livewire\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // dynamically set the rootview based on whether the route is backend or frontend
        // can also be done in a middleware that wraps all admin routes
        if(request()->is('admin/*')){
            //Inertia::setRootView('admin.app');
        } elseif(request()->is('questions*')) {
            Inertia::setRootView('question.master');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        Inertia::share('flash', function () {
            return [
                'successMsg' => Session::get('successMsg'),
            ];
        });
    }
}
