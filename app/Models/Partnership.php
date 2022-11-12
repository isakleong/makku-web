<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    use HasFactory;

    protected $table = 'partnership';

    protected $fillable = [
        'name',
        'image',
        'logo',
        'address',
        'instagram',
        'whatsapp',
        'phoneNo',
        'active'
    ];
}
