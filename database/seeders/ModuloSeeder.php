<?php

namespace Database\Seeders;

use App\Models\Modulo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Módulos -> id inserido manualmente de acordo com o cronograma
        Modulo::create([
            'id' => 5086,
            'nome' => 'Programação em SQL',
            'turma_id' => 4,
            'formador_id' => 103,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5087,
            'nome' => 'WEB - ferramentas multimédia',
            'turma_id' => 4,
            'formador_id' => 103,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5088,
            'nome' => 'Desenvolvimento de Aplicações Mobile',
            'turma_id' => 4,
            'formador_id' => 101,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5089,
            'nome' => 'Programação - Algoritmos',
            'turma_id' => 4,
            'formador_id' => 101,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5090,
            'nome' => 'Integração de sistemas de informação - ferramentas',
            'turma_id' => 4,
            'formador_id' => 102,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5091,
            'nome' => 'Projeto de tecnologias e programação de sistemas de informação',
            'turma_id' => 4,
            'formador_id' => 102,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5092,
            'nome' => 'WEB - hipermédia e acessibilidades',
            'turma_id' => 4,
            'formador_id' => 103,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5409,
            'nome' => 'Engenharia de Software',
            'turma_id' => 4,
            'formador_id' => 102,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5410,
            'nome' => 'Bases de dados - conceitos',
            'turma_id' => 4,
            'formador_id' => 103,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5412,
            'nome' => 'Programação de computadores - estruturada',
            'turma_id' => 4,
            'formador_id' => 101,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5413,
            'nome' => 'Programação de computadores - orientada a objetos',
            'turma_id' => 4,
            'formador_id' => 101,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5414,
            'nome' => 'Programação para a WEB - cliente (client side)',
            'turma_id' => 4,
            'formador_id' => 103,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5417,
            'nome' => 'Programação para a WEB - servidor (server side)',
            'turma_id' => 4,
            'formador_id' => 103,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5420,
            'nome' => 'Integração de sistemas de informação - conceitos',
            'turma_id' => 4,
            'formador_id' => 102,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5421,
            'nome' => 'Integração de sistemas de informação - tecnologias e níveis de Integração',
            'turma_id' => 4,
            'formador_id' => 102,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 5423,
            'nome' => 'Acesso móvel a sistemas de informação',
            'turma_id' => 4,
            'formador_id' => 101,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 6404,
            'nome' => 'Inglês técnico aplicado às telecomunicações',
            'turma_id' => 4,
            'formador_id' => 104,
            'carga_horaria' => 25,
        ]);

        Modulo::create([
            'id' => 8599,
            'nome' => 'Comunicação assertiva e técnicas de procura de emprego',
            'turma_id' => 4,
            'formador_id' => 105,
            'carga_horaria' => 25,
        ]);
    }
}
