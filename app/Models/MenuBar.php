<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuBar extends Model
{
    use HasFactory;

    protected $table = 'menu_bar';

    protected $fillable = [
        'title_en',
        'title_id',
        'orderNumber',
        'refer',
        'type',
        'parent',
        'image',
        'active'
    ];
}
