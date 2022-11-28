<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $table = 'news_category';

    protected $fillable = [
        'name_en',
        'name_id',
        'slug',
        'active'
    ];
}
