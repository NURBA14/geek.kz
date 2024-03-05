<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate([
            "text" => "required"
        ]);
        Comment::create([
            "text" => $request->text,
            "post_id" => $post_id,
            "user_id" => Auth::user()->id
        ]);
        return redirect()->back();
    }



    public function delete($id)
    {
        Comment::destroy($id);
        session()->flash("success", "Comment is deleted");
        return redirect()->back();
    }
}
