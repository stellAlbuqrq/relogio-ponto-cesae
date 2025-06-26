<?php

namespace Database\Seeders;

use App\AcaoPresenca as AppAcaoPresenca;
use App\Models\Presenca;
use App\Models\Cronograma;
use App\Enums\AcaoPresenca;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PresencaSeeder extends Seeder
{
    public function run(): void
    {
        $alunoId = 201;
        $inicio = Carbon::create(2025, 2, 17);
        $hoje = Carbon::today();

        $cronogramas = Cronograma::whereBetween('data', [$inicio, $hoje])->get();

        foreach ($cronogramas as $cronograma) {
            $temCheckIn = fake()->boolean(90);
            $temCheckOut = fake()->boolean(85);

            $horaInicio = Carbon::parse($cronograma->hora_inicio);
            $horaFim = Carbon::parse($cronograma->hora_fim);

            if ($temCheckIn) {
                $checkInAleatorio = $horaInicio->copy()->addMinutes(rand(0, 20));
                Presenca::create([
                    'aluno_id' => $alunoId,
                    'cronograma_id' => $cronograma->id,
                    'acao' => AppAcaoPresenca::CheckIn,
                    'pin' => fake()->unique()->numerify('####'),
                    'created_at' => $checkInAleatorio,
                    'updated_at' => $checkInAleatorio,
                ]);
            }

            if ($temCheckOut) {
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
        }
    }
}
