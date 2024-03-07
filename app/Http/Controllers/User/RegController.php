<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegController extends Controller
{
    public function create()
    {
        return view("user.reg.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
            "remember_me" => "nullable"
        ]);
        if(isset($request->remember_me)){
            $remember_me = true;
        }else{
            $remember_me = false;
        }
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);
        $request->session()->flash("success", "You have registered");
        Auth::login($user, $remember_me);
        return redirect()->route("reg.mail");
    }
}
