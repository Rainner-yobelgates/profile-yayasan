<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = [
        'activity',
        'description',
        'order',
        'slug',
        'status',
    ];

    public function sluggable() :array
    {
        return [
            'slug' => [
                'source' => 'activity'
            ]
        ];
    }
}
