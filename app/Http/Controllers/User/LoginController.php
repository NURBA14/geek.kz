<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view("user.login.create");
    }


    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
            "remember_me" => "nullable"
        ]);
        if(isset($request->remember_me)){
            $remember_me = true;
        }else{
            $remember_me = false;
        }
        if (Auth::attempt(["email" => $request->email, "password" => $request->password], $remember_me)) {
            $request->session()->flash("success", "You are logged");
            if (Auth::user()->is_admin == 1) {
                return redirect()->route("admin.index");
            } else {
                return redirect()->route("home");
            }
        }
        return redirect()->back()->with("error", "Incorrect login or password");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }
}
