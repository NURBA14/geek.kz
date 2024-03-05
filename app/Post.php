<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "description",
        "content",
        "category_id",
        "thumbnail",
        "user_id"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile("thumbnail")) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date("Y-m-d");
            return $request->file("thumbnail")->store("images/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->thumbnail) {
            return asset("uploads/images/default/no-image.png");
        }
        return asset("uploads/" . $this->thumbnail);
    }

    public function getPostDate()
    {
        return Carbon::createFromFormat("Y-m-d H:i:s", $this->created_at)->format("d F, Y");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeLike($query, $s)
    {
        return $query->where("title", "LIKE", "%{$s}%");
    }
}
