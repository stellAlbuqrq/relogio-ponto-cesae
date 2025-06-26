<?php

namespace Database\Factories;

use App\AcaoPresenca as AppAcaoPresenca;
use App\Models\Presenca;
use App\Models\User;
use App\Models\Cronograma;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\AcaoPresenca;

class PresencaFactory extends Factory
{
    protected $model = Presenca::class;

    public function definition(): array
    {
        return [
            'aluno_id' => 201,
            'cronograma_id' => Cronograma::inRandomOrder()->first()->id,
            'acao' => $this->faker->randomElement([AppAcaoPresenca::CheckIn, AppAcaoPresenca::CheckOut]),
            'pin' => $this->faker->unique()->numerify('####'),
            'comentario' => $this->faker->optional()->sentence(),
        ];
    }
}
