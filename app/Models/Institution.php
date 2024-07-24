<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = [
        'logo',
        'name',
        'description',
        'order',
        'status',
        'slug'
    ];

    public function sluggable() :array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
