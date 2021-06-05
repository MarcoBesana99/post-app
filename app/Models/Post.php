<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LamaLama\Wishlist\HasWishlists;

class Post extends Model
{
    use HasFactory;
    use HasWishlists;

    protected $fillable = [
        'title',
        'content',
        'images_path',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
