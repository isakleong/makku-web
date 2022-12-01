<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'product';

    protected $fillable = [
        'categoryID',
        'brandID',
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

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'categoryID', 'id');
    }

    public function brand(){
        return $this->belongsTo(ProductBrand::class, 'brandID', 'id');
    }
}
