<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with("category", "tags")->orderBy("created_at", "DESC")->paginate(10);
        return view("admin.posts.index", compact("posts"));
    }

    public function create()
    {
        $categories = Category::pluck("title", "id")->all();
        $tags = Tag::pluck("title", "id")->all();
        return view("admin.posts.create", compact("categories", "tags"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "content" => "required",
            "category_id" => "required|integer",
            "thumbnail" => "required|image"
        ]);
        $data = $request->all();
        $data["thumbnail"] = Post::uploadImage($request);
        $post = Post::create([
            "title" => $data["title"],
            "slug" => Str::slug($data["title"]),
            "description" => $data["description"],
            "content" => $data["content"],
            "category_id" => $data["category_id"],
            "thumbnail" => $data["thumbnail"],
            "user_id" => auth()->user()->id
        ]);
        $post->tags()->sync($request->tags);
        $request->session()->flash("success", "The post is saved");
        return redirect()->route("posts.index");
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck("title", "id")->all();
        $tags = Tag::pluck("title", "id")->all();
        return view("admin.posts.edit", compact("post", "categories", "tags"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "content" => "required",
            "category_id" => "required|integer",
            "thumbnail" => "nullable|image"
        ]);
        $post = Post::find($id);
        $data = $request->all();
        $data["thumbnail"] = Post::uploadImage($request, $post->thumbnail);
        $post->update([
            "title" => $data["title"],
            "slug" => $post->slug,
            "description" => $data["description"],
            "content" => $data["content"],
            "category_id" => $data["category_id"],
            "thumbnail" => $data["thumbnail"] ?? $post->thumbnail,
            "user_id" => auth()->user()->id
        ]);
        $post->tags()->sync($request->tags);
        $request->session()->flash("success", "The post has been changed");
        return redirect()->route("posts.index");
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->sync([]);
        Storage::delete($post->thumbnail);
        $post->delete();
        session()->flash("success", "The post has been deleted");
        return redirect()->route("posts.index");
    }

}
