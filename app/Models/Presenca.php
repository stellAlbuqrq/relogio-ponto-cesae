<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presenca extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id', 'cronograma_id', 'check_in', 'check_out', 'justificativa', 'anexo'];

    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function cronograma()
    {
        return $this->belongsTo(Cronograma::class);
    }
}
