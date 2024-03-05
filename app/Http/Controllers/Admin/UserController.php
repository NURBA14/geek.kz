<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        $posts = Auth::user()->posts()->orderBy("created_at", "DESC")->paginate(4);
        return view("admin.user.profile", compact("posts"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "work" => "nullable",
            "location" => "nullable",
            "skills" => "nullable",
            "des" => "nullable",
            "avatar" => "nullable|image"
        ]);
        $user = User::find(Auth::user()->id);
        $res = $user->deleteAvatar(Auth::user()->avatar);
        $path = $user->getAvatarPath($request);
        $user->update([
            "name" => $request->name,
            "avatar" => $path,
            "work" => $request->work ?? $user->work,
            "location" => $request->location ?? $user->location,
            "skills" => $request->skills ?? $user->skills,
            "des" => $request->des ?? $user->des,
        ]);
        $request->session()->flash("success", "Data is saved");
        return redirect()->route("admin.profile");
    }


    public function admins()
    {
        $admins = User::with("posts", "comments")->where("is_admin", "=", 1)->paginate(10);
        return view("admin.user.admins", compact("admins"));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->update([
            "is_admin" => 0
        ]);
        session()->flash("success", "{$user->name} is user");
        return redirect()->route("users.users.table");
    }

    public function users()
    {
        $users = User::with("posts", "comments")->where("is_admin", "=", 0)->orderBy("created_at", "DESC")->paginate(10);
        return view("admin.user.users", compact("users"));
    }

    public function add_admin($id)
    {
        $user = User::find($id);
        $user->update([
            "is_admin" => 1
        ]);
        session()->flash("success", "{$user->name} is admin");
        return redirect()->route("users.admins.table");
    }
}
