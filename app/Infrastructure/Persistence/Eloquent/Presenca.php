<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
