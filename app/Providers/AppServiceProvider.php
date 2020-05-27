<?php

namespace App\Providers;

use App\Articale;
use App\Category;
use App\Observers\ArticaleObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\ServiceProvider;
use App\Tag;
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
        Category::observe(CategoryObserver::class);
        Articale::observe(ArticaleObserver::class);

        // wildcart route

        view()->composer('*', function($view){
            $view->with('tags',Tag::all());
            $view->with('categories',Category::all());
        });
    }
}
