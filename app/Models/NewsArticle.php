<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class NewsArticle extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'news_article';

    protected $fillable = [
        'categoryID',
        'title_en',
        'title_id',
        'slug',
        'content_en',
        'content_id',
        'image'
    ];

    public function category() {
        return $this->belongsTo(NewsCategory::class);
    }

    public function __construct(array $attributes = []) {}

}
