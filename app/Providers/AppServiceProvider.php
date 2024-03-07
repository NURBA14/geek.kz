<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer("layouts.sidebar", function ($view) {
            $view->with("popular_posts", Post::orderBy("views", "DESC")->limit(5)->get());
            $view->with("popular_categories", Category::withCount("posts")->orderBy("posts_count", "desc")->limit(6)->get());
            $view->with("popular_tags", Tag::withCount("posts")->orderBy("posts_count", "desc")->limit(6)->get());
        });
    }
}
