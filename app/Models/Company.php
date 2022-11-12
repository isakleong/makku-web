<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'name',
        'highlight_en',
        'highlight_id',
        'description_en',
        'description_id',
        'image',
        'logoPrimary',
        'logoSecondary',
        'address',
        'email',
        'facebook',
        'instagram',
        'whatsapp'
    ];
}
