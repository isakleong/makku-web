<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $table = 'news_article';

    protected $fillable = [
        'categoryID',
        'title_en',
        'title_id',
        'slug_en',
        'slug_id',
        'content_en',
        'content_id',
        'tags_en',
        'tags_id',
        'image',
        'author'
    ];

    public function category() {
        return $this->belongsTo(NewsCategory::class);
    }

}
