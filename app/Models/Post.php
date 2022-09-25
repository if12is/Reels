<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $guarded = [];
    use HasFactory;
    protected $fillable = ['title', 'body', 'user_id', 'category_id'];

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function like()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isAuthUserLikedPost()
    {
        return $this->likes()->where('user_id',  auth()->id())->exists();
    }
}
