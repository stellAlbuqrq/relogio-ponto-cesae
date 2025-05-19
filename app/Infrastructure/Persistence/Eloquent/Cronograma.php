<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cronograma extends Model
{
    use HasFactory;

    protected $fillable = [
        'turma_id',
        'modulo_id',
        'data',
        'dia_semana',
        'hora_inicio',
        'hora_fim',
        'duracao'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function presencas()
    {
        return $this->hasMany(Presenca::class);
    }
}
