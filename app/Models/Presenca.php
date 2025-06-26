<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Presenca extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'cronograma_id',
        'acao',
        'pin',
        'comentario',
    ];

    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function cronograma()
    {
        return $this->belongsTo(Cronograma::class);
    }

   
}
