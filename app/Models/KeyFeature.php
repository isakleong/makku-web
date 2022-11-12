<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyFeature extends Model
{
    use HasFactory;

    protected $table = 'key_feature';

    protected $fillable = [
        'name_en',
        'name_id',
        'image',
        'orderNumber',
        'active'
    ];
}
