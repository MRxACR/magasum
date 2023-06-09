<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Inventaire;
use App\Models\TypeArticle;
use App\Models\Unite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'desg_art' => fake()->sentence(),
            'nsr_art' => fake()->bothify('??##???####?'),
            'n_inventaire' => fake()->numerify('######/sdmm/').fake()->randomNumber(2, true),
            'qte_init' => fake()->numberBetween(30, 200),
            'qte_stock' => fake()->numberBetween(0, 10),
            'qte_alt' => fake()->numberBetween(1, 50),
            'prix' => fake()->randomFloat(2, 100, 10000),
            'type_id' => TypeArticle::inRandomOrder()->first()->id,
            'categorie_id' => Categorie::inRandomOrder()->first()->id,
            'unite_id' => Unite::inRandomOrder()->first()->id,
            'date_expiration' => fake()->dateTimeBetween('-2 year', '+2 year'),
        ];
    }
}
