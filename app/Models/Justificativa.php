<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Justificativa extends Model
{
    use HasFactory;


    protected $casts = [
        'data_justificada' => 'date',  // para converter para Carbon
    ];


    protected $fillable = [
        'aluno_id',
        'cronograma_id',
        'periodo',
        'data_justificada',
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

    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function cronograma()
    {
        return $this->belongsTo(Cronograma::class, 'cronograma_id');
    }
}
