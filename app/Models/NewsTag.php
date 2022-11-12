<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
    use HasFactory;

    protected $table = 'news_tag';

    protected $fillable = [
        'name_en',
        'name_id',
        'active'
    ];
}
