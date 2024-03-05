<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $latest_posts = Post::with("category", "user", "tags", "comments")->orderBy("created_at", "DESC")->limit(5)->get();
        $popularity_posts = Post::with("comments")->orderBy("views", "DESC")->limit(5)->get();
        $categories = Category::all();
        $latest_users = User::where("is_admin", "=", 0)->orderBy("created_at", "DESC")->limit(4)->get();
        $latest_admins = User::where("is_admin", "=", 1)->orderBy("created_at", "DESC")->limit(4)->get();
        $users = User::where("is_admin", "=", 0)->count();
        $admins = User::where("is_admin", "=", 1)->count();
        $tags = Tag::all()->count();
        $comments = Comment::all()->count();
        $views = 0;
        foreach ($posts as $post) {
            $views += $post->views;
        }
        $activity = ((($comments + $views) / count($posts)) / $users) * 100;
        return view("admin.index", compact("posts", "categories", "users", "views", "tags", "comments", "admins", "activity", "latest_posts", "latest_users", "latest_admins", "popularity_posts"));
    }
}
