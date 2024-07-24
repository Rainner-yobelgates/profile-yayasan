<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = [
        'title',
        'thumbnail',
        'slug',
        'content',
        'created_by',
        'order',
        'status',
    ];

    public function sluggable() :array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
