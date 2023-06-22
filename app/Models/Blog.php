<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['blog_id', 'blog_title', 'blog_slug', 'blog_picture', 'blog_body', 'blog_status', 'blog_views'];


    public function sluggable(): array
    {
        return [
            'blog_slug' => [
                'source' => 'blog_title'
            ]
        ];
    }
}
