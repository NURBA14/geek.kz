<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with("posts")->where("id", ">", 0)->get();
        $i = 1;
        return view("categories.index", compact("categories", "i"));
    }

    public function show($slug)
    {
        $category = Category::where("slug", "=", $slug)->firstOrFail();
        $posts = $category->posts()->orderBy("created_at", "DESC")->paginate(4);
        $count = $category->posts()->orderBy("created_at", "DESC")->count();
        return view("categories.show", compact("posts", "category", "count"));
    }
}
