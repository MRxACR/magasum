<?php

namespace Database\Factories;

use App\Models\Livraison;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reception>
 */
class ReceptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'n_reception' => fake()->numerify('N°####/').fake()->date('Y'),
            'date_reception' => fake()->date(),
            'n_marche' => fake()->unique()->numerify('M°-##########'),
            'consultation' => fake()->unique()->numerify('C°-##########'),
            'tva' => fake()->numberBetween(0, 30),
            'n_livraison' => Livraison::inRandomOrder()->first()->n_livraison,
        ];
    }
}
