<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'turma_id', 'formador_id', 'carga_horaria'];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function formador()
    {
        return $this->belongsTo(User::class, 'formador_id');
    }

    public function alunos()
    {
        return $this->belongsToMany(User::class, 'modulo_user', 'modulo_id', 'aluno_id');
    }

    public function cronogramas()
    {
        return $this->hasMany(Cronograma::class);
    }
}
