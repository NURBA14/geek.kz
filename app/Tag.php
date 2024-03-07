<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        "title", "slug"
    ];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
