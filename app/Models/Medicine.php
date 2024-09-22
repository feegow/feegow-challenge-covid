<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lot',
        'expiration_date',
    ];

    protected $casts = [
        'expiration_date' => 'datetime',
    ];
}
