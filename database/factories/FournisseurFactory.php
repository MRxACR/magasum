<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fournisseur>
 */
class FournisseurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rs' => fake()->unique()->company(),
            'nom' => fake()->firstName(),
            'prenom' => fake()->lastName(),
            'tel' => fake()->unique()->phoneNumber(),
            'fax' => fake()->unique()->phoneNumber(),
            'Adr' => fake()->address(),
            'willaya' => fake()->city(),
            'rc' => fake()->unique()->numerify('rc-##########'),
            'ai' => fake()->unique()->numerify('ai-##########'),
            'mf' => fake()->unique()->numerify('mf-##########'),
        ];
    }
}
