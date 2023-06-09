<?php

namespace Database\Factories;

use App\Models\Sortie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reforme>
 */
class ReformeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sortie_id' => Sortie::inRandomOrder()->first()->id,
            'motif' => fake()->sentence(20),
        ];
    }
}
