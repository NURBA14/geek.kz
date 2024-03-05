<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $comments = Auth::user()->comments()->with("post")->orderBy("created_at", "DESC")->paginate(10);
        return view("user.profile", compact("comments"));
    }


    public function edit()
    {
        return view("user.edit");
    }

    public function update(Request $request)
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
        $path = $user->getUserAvatarPath($request);
        $user->update([
            "name" => $request->name,
            "avatar" => $path,
            "work" => $request->work ?? $user->work,
            "location" => $request->location ?? $user->location,
            "skills" => $request->skills ?? $user->skills,
            "des" => $request->des ?? $user->des,
        ]);
        $request->session()->flash("success", "Data is saved");
        return redirect()->route("user.profile");
    }
}
