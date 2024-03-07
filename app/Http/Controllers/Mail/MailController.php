<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\BanMail;
use App\Mail\RegMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function reg()
    {
        Mail::to(Auth::user()->email)->send(new RegMail(Auth::user()->name, Auth::user()->email));
        session()->flash("success", "You have registered");
        return redirect()->route("home");
    }
}
