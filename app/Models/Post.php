<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'content', 'image', 'published_at', 'category_id', 'user_id'
    ];

    protected $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return '/storage/images/posts/'. $this->image;
    }

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function deleteImage()
    {
        Storage::delete('/public/images/posts/' .$this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
