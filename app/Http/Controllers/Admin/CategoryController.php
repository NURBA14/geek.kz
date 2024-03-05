<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with("posts")->orderBy("created_at", "DESC")->paginate(10);
        return view("admin.categories.index", compact("categories"));
    }

    public function create()
    {
        return view("admin.categories.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required"
        ]);
        Category::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
        ]);
        $request->session()->flash("success", "The category is saved");
        return redirect()->route("categories.index");
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view("admin.categories.edit", compact("category"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required"
        ]);
        $category = Category::find($id);
        $category->update([
            "title" => $request->title,
            "slug" => $category->slug,
        ]);
        $request->session()->flash("success", "The category has been changed");
        return redirect()->route("categories.index");
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->posts->count()) {
            session()->flash("error", "Category has posts");
            return redirect()->route("categories.index");
        }
        ;
        $category->delete();
        session()->flash("success", "The category has been deleted");
        return redirect()->route("categories.index");
    }
}
