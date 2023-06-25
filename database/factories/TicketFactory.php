<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function Sodium\increment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $usuario = 1;
        static $proyecto = 1;

        return [
            'id_proyecto' => $proyecto,
            'id_usuario' => $usuario,
            'titulo' => fake()->title,
            'estado' => 'nuevo',
            'descripcion' => fake()->paragraph,
        ];
    }
}
