<?php

namespace Database\Factories;

use App\Models\Facture;
use App\Models\Commande;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livraison>
 */
class LivraisonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'n_livraison' => fake()->numerify('N°-#### ').fake()->date('Y'),
            'n_facture' => Facture::inRandomOrder()->first()->n_facture,
            'n_cmd' => Commande::inRandomOrder()->first()->n_cmd,
            'date_livraison' => fake()->date(),
        ];
    }
}
