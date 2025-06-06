<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CursoSeeder::class,
            TurmaSeeder::class,
            UserSeeder::class,
            ModuloSeeder::class,
            //Cronograma fizemos a importação do excel diretamente no mysql por causa da quantidade de dados
        ]);
    }
}
