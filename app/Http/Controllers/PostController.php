<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with("category")->orderBy("created_at", "DESC")->paginate(5);
        return view("posts.index", compact("posts"));
    }

    public function show($slug)
    {
        $post = Post::with("category", "tags", "user", "comments")->where("slug", "=", $slug)->firstOrFail();
        $comments = Comment::with("user")->where("post_id", "=", $post->id)->orderBy("created_at", "DESC")->get();
        $post->views += 1;
        $post->update();
        return view("posts.show", compact("post", "comments"));
    }


    public function search(Request $request)
    {
        $request->validate([
            "s" => "required"
        ]);
        $s = $request->s;
        $posts = Post::with("user", "category")->like($s)->orderBy("created_at", "DESC")->paginate(4);
        $count = Post::with("user", "category")->like($s)->count();
        return view("posts.search", compact("posts", "s", 'count'));
    }
}
