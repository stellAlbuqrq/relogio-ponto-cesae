<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presenca>
 */
class PresencaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            // Exemplo chat:
            // 'aluno_id' => User::factory(), // Ou usa um ID fixo se já existirem users com role "aluno"
            // 'cronograma_id' => Cronograma::factory(), // Ou ID existente
            // 'acao' => $this->faker->randomElement(['check_in', 'check_out']),
            // 'pin' => $this->faker->numberBetween(1000, 9999),
            // 'comentario' => $this->faker->boolean(30) ? $this->faker->sentence() : null,
            // 'registrado_em' => $this->faker->dateTimeBetween('-1 week', 'now'),

        ];
    }
}
