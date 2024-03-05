<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with("user", "post")->orderBy("created_at", "DESC")->paginate(10);
        return view("admin.comments.index", compact("comments"));
    }

    public function delete($id)
    {
        Comment::destroy($id);
        session()->flash("success", "Comment is deleted");
        return redirect()->route("comments.table");
    }

}
