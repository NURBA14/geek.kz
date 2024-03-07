<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "avatar",
        "work",
        "location",
        "skills",
        "des",
        "is_admin",
        "active"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarPath(Request $request)
    {
        if ($request->hasFile("avatar")) {
            $folder = date("Y-m-d");
            return $request->file("avatar")->store("admin/{$folder}");
        } else {
            return null;
        }
    }

    public function deleteAvatar($avatar)
    {
        if ($avatar) {
            Storage::delete($avatar);
            return null;
        }
        return null;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getUserAvatarPath(Request $request)
    {
        if ($request->hasFile("avatar")) {
            $folder = date("Y-m-d");
            return $request->file("avatar")->store("user/{$folder}");
        } else {
            return null;
        }
    }


    public function getUserDate()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getAva()
    {
        if ($this->avatar) {
            return "uploads/{$this->avatar}";
        } else {
            return "uploads/user/default/default.jpg";
        }
    }


}

