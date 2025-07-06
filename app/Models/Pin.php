<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    protected $table = 'pin';

    use HasFactory;

    protected $fillable = [
        'cronograma_id',
        'pin',
        'expires_at',
    ];
}
