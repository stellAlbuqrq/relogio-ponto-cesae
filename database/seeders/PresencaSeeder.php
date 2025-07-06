<?php

namespace Database\Seeders;

use App\AcaoPresenca as AppAcaoPresenca;
use App\Models\Presenca;
use App\Models\Cronograma;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PresencaSeeder extends Seeder
{
    public function run(): void
    {
        $alunoInicial = 201;
        $alunoFinal = 217;
        $inicio = Carbon::create(2025, 2, 17);
        $hoje = Carbon::today();

        $cronogramas = Cronograma::whereBetween('data', [$inicio, $hoje])->get();

        foreach ($cronogramas as $cronograma) {
            $horaInicio = Carbon::parse($cronograma->hora_inicio);
            $horaFim = Carbon::parse($cronograma->hora_fim);

            for ($alunoId = $alunoInicial; $alunoId <= $alunoFinal; $alunoId++) {

                $estaPresente = fake()->boolean(75);

                if ($estaPresente) {
                    // Cria check-in
                    $checkInAleatorio = $horaInicio->copy()->addMinutes(rand(0, 20));
                    Presenca::create([
                        'aluno_id' => $alunoId,
                        'cronograma_id' => $cronograma->id,
                        'acao' => AppAcaoPresenca::CheckIn,
                        'pin' => fake()->unique()->numerify('####'),
                        'created_at' => $checkInAleatorio,
                        'updated_at' => $checkInAleatorio,
                    ]);

                    // Cria check-out
                    $checkOutAleatorio = $horaFim->copy()->subMinutes(rand(0, 20));
                    Presenca::create([
                        'aluno_id' => $alunoId,
                        'cronograma_id' => $cronograma->id,
                        'acao' => AppAcaoPresenca::CheckOut,
                        'pin' => fake()->unique()->numerify('####'),
                        'created_at' => $checkOutAleatorio,
                        'updated_at' => $checkOutAleatorio,
                    ]);
                }
                // Se não estiver presente, não cria nenhum registro = ausente
            }
        }
    }
}
