<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function admins(Request $request)
    {
        $request->validate([
            "s" => "required"
        ]);
        $s = $request->s;
        $admins = User::with("comments", "posts")->where("is_admin", "=", "1")->where("Name", "LIKE", "%{$s}%")->paginate(10);
        $count = count($admins);
        return view("admin.user.admins.search", compact("admins", "count", "s"));
    }

    public function users(Request $request)
    {
        $request->validate([
            "s" => "required"
        ]);
        $s = $request->s;
        $users = User::with("comments", "posts")->where("is_admin", "=", "0")->where("Name", "LIKE", "%{$s}%")->paginate(10);
        $count = count($users);
        return view("admin.user.users.search", compact("users", "count", "s"));
    }

    public function posts(Request $request)
    {
        $request->validate([
            "s" => "required"
        ]);
        $s = $request->s;
        $posts = Post::with("user", "category", "tags", "comments")->like($s)->orderBy("created_at", "DESC")->paginate(10);
        $count = count($posts);
        return view("admin.posts.search", compact("posts", "s", 'count'));
    }

    public function comments(Request $request)
    {
        $request->validate([
            "s" => "required"
        ]);
        $s = $request->s;
        $user = User::with("comments")->where("name", "LIKE", "%{$s}%")->first();
        if ($user) {
            $comments = $user->comments;
            $count = count($comments);
        } else {
            $request->session()->flash("error", "Comments not found");
            return redirect()->back();
        }
        return view("admin.comments.search", compact("comments", "count", "s"));
    }

    public function categories(Request $request)
    {
        $request->validate([
            "s" => "required"
        ]);
        $s = $request->s;
        $categories = Category::with("posts")->where("title", "LIKE", "%{$s}%")->paginate(10);
        $count = count($categories);
        return view("admin.categories.search", compact("categories", "s", 'count'));
    }

    public function tags(Request $request)
    {
        $request->validate([
            "s" => "required"
        ]);
        $s = $request->s;
        $tags = Tag::with("posts")->where("title", "LIKE", "%{$s}%")->paginate(10);
        $count = count($tags);
        return view("admin.tags.search", compact("tags", "s", 'count'));
    }
}
