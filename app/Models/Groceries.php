<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Groceries extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'package_name',
        'slug',
        'price_point',
        'stock',
        'image',
        'description'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'package_name'
            ]
        ];
    }
}
