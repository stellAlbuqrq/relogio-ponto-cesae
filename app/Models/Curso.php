<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'nome'
    ];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }
}
