<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with("posts")->orderBy("created_at", "DESC")->paginate(10);
        return view("admin.tags.index", compact("tags"));
    }

    public function create()
    {
        return view("admin.tags.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required"
        ]);
        Tag::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
        ]);
        $request->session()->flash("success", "The tag is saved");
        return redirect()->route("tags.index");
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view("admin.tags.edit", compact("tag"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required"
        ]);
        $tag = Tag::find($id);
        $tag->update([
            "title" => $request->title,
            "slug" => $tag->slug,
        ]);
        $request->session()->flash("success", "The tag has been changed");
        return redirect()->route("tags.index");
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag->posts->count()) {
            session()->flash("error", "Tag has posts");
            return redirect()->route("tags.index");
        }
        $tag->delete();
        session()->flash("success", "The tag has been deleted");
        return redirect()->route("tags.index");
    }
}
