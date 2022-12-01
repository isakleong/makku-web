<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'product_category';

    protected $fillable = [
        'name_en',
        'name_id',
        'slug',
        'image',
        'active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_id'
            ]
        ];
    }

    public function product(){
        return $this->hasMany(Product::class, 'categoryID', 'id');
    }

}
