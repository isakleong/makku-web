<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   NewsCategory extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'news_category';

    protected $fillable = [
        'name_en',
        'name_id',
        'slug',
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

    public function news(){
        return $this->hasMany(NewsArticle::class, 'categoryID', 'id');
    }
}
