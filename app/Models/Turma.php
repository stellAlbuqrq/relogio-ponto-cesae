<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'curso_id',
        
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function cronogramas()
    {
        return $this->hasMany(Cronograma::class);
    }
}
