<?php

namespace App;

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
        "thumbnail"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
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



}
