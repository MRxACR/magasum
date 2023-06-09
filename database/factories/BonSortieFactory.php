<?php

namespace Database\Factories;

use App\Models\Sortie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonSortie>
 */
class BonSortieFactory extends Factory
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
            'service' => fake()->company(),
        ];
    }
}
