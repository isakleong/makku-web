<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHighlight extends Model
{
    use HasFactory;

    protected $table = 'product_highlight';

    protected $fillable = [
        'name_en',
        'name_id',
        'image',
        'orderNumber',
        'active'
    ];
}
