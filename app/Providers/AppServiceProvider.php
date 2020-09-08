<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Category;

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

        // $this->app->bind('path.public', function() {
        //     return base_path().'/../public_html';
        // });
        
        $category = Category::take(6)->orderBy('id', 'ASC')->get();

        View::share('categories', $category);
    }
}
