<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User Admin:
        User::create([
            'id' => 100,
            'nome' => 'José',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        //User Formadores:
        User::create([
            'id' => 101,
            'nome' => 'Sara',
            'email' => 'sara@example.com',
            'password' => bcrypt('password123'),
            'role' => 'formador',
        ]);

        User::create([
            'id' => 102,
            'nome' => 'Ana',
            'email' => 'ana@example.com',
            'password' => bcrypt('password123'),
            'role' => 'formador',
        ]);

        User::create([
            'id' => 103,
            'nome' => 'Rui',
            'email' => 'rui@example.com',
            'password' => bcrypt('password123'),
            'role' => 'formador',
        ]);

        User::create([
            'id' => 104,
            'nome' => 'Hugo',
            'email' => 'hugo@example.com',
            'password' => bcrypt('password123'),
            'role' => 'formador',
        ]);

        User::create([
            'id' => 105,
            'nome' => 'Filipa',
            'email' => 'filipa@example.com',
            'password' => bcrypt('password123'),
            'role' => 'formador',
        ]);

        //User Alunos:
        User::create([
            'id' => '201',
            'nome' => 'Carmem',
            'email' => 'carmem.zavattieri.298335670@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => '202',
            'nome' => 'Júlia',
            'email' => 'julia.santos.304343595@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => '203',
            'nome' => 'Stéphanie',
            'email' => 'stephanie.albuquerque.300297262@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);
    }
}
