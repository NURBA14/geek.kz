<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with("posts")->where("id", ">", 0)->get();
        $i = 1;
        return view("tags.index", compact("tags", "i"));
    }

    public function show($slug)
    {
        $tag = Tag::where("slug", "=", $slug)->firstOrFail();
        $posts = $tag->posts()->with("category")->orderBy("created_at", "DESC")->paginate(4);
        $count = $tag->posts()->with("category")->orderBy("created_at", "DESC")->count();
        return view("tags.show", compact("posts", "tag", "count"));
    }
}
