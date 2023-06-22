<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['event_id', 'event_title', 'event_date', 'event_slug', 'event_picture', 'event_body', 'event_status'];


    public function sluggable(): array
    {
        return [
            'event_slug' => [
                'source' => 'event_title'
            ]
        ];
    }
}
