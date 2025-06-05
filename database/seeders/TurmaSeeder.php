<?php

namespace Database\Seeders;

use App\Models\Turma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Turma::create([
            'id' => 4,
            'nome' => 'Software Developer Braga',
            'curso_id' => 1,
        ]);
    }
}
