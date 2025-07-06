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
            'id' => 201,
            'nome' => 'Carmem',
            'email' => 'carmem.zavattieri.298335670@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 202,
            'nome' => 'Júlia',
            'email' => 'julia.santos.304343595@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 203,
            'nome' => 'Stéphanie',
            'email' => 'stephanie.albuquerque.300297262@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 204,
            'nome' => 'Amanda Brito',
            'email' => 'amanda.brito.319059677@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 205,
            'nome' => 'Angela Peixoto',
            'email' => 'angela.peixoto.268650616@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 206,
            'nome' => 'Angélica Olivares',
            'email' => 'angelica.olivares.307861643@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 207,
            'nome' => 'Bruna Silva',
            'email' => 'bruna.silva.233921630@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 208,
            'nome' => 'Fabiane Nascimento',
            'email' => 'fabiane.nascimento.299931366@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 209,
            'nome' => 'Joana Ventuzelos',
            'email' => 'joana.ventuzelos.269157921@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 210,
            'nome' => 'José Fernandes',
            'email' => 'jose.fernandes.214496210@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 211,
            'nome' => 'Luís Basto',
            'email' => 'luis.basto.265784700@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 212,
            'nome' => 'Luís Mago',
            'email' => 'luis.mago.298162059@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 213,
            'nome' => 'Pedro Lopes',
            'email' => 'pedro.lopes.301624089@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 214,
            'nome' => 'Pedro Rodrigues',
            'email' => 'pedro.rodrigues.246839147@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 215,
            'nome' => 'Rui Silva',
            'email' => 'rui.silva.242957803@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 216,
            'nome' => 'Tiago Felix',
            'email' => 'tiago.felix.247189685@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);

        User::create([
            'id' => 217,
            'nome' => 'Viviane Dias',
            'email' => 'viviane.dias.251078493@msft.cesae.pt',
            'password' => bcrypt('password123'),
            'role' => 'aluno',
        ]);
    }
}
