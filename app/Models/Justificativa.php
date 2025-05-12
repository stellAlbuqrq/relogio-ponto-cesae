<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Justificativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'presenca_id',
        'texto',
        'anexo',
        'status',
        'avaliado_por',
        'avaliado_em'
    ];

    public function presenca()
    {
        return $this->belongsTo(Presenca::class);
    }

    public function avaliador()
    {
        return $this->belongsTo(User::class, 'avaliado_por');
    }
}
