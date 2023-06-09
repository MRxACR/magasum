<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sortie>
 */
class SortieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ["bs","pc","rf"];
        return [
            'num' =>  $types[random_int(0,2)].'/'.fake()->numerify('####/').fake()->date('Y'),
            'nom' => fake()->firstName(),
            'prenom' => fake()->lastName(),
            "date" => fake()->dateTimeBetween('-2 year', '+2 year'),
            "type" => $types[random_int(0,2)],
            "signer" => random_int(0,1),
        ];
    }
}
