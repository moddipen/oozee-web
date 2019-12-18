<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Cms;
use App\Models\Country;
use App\Models\News;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Share common data
        $pages = Cms::where('status', 1)->get();
        View::share('commonPages', $pages);

        $news = News::with('creator')->where('status', 1)->orderBy('id', 'desc')->take(3)->get();
        View::share('commonNews', $news);

        $blogs = Blog::with('creator')->where('status', 1)->orderBy('id', 'desc')->take(3)->get();
        View::share('commonBlogs', $blogs);

        $countries = Country::all();
        View::share('countries', $countries);
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
