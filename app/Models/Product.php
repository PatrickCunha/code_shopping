<?php

namespace CodeShopping\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
            ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function productInputs()
    {
        return $this->hasMany(ProductInput::class);
    }

}