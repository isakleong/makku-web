<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;

    protected $table = 'catalogue';

    protected $fillable = [
        'file',
        'name_en',
        'name_id',
        'active'
    ];
}
