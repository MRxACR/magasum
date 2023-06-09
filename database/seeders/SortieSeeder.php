<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Sortie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SortieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sortie::factory(20)->create();

        foreach (Sortie::all() as $sortie) {
            for ($i = 0; $i < 10; $i++) {
                try {
                    $sortie->articles()->attach(
                        random_int(1, 200),
                        [
                            "quantity" => random_int(0, 200),
                            "observation" => fake()->sentence(6),
                            "prix" => fake()->randomFloat(2, 100, 10000),
                        ]
                    );
                } catch (\Throwable $th) {
                    //
                }
                // try {
                //     $sortie->articles()->attach(
                //         random_int(1, 200),
                //         [
                //             "quantity" => random_int(0, 200),
                //             "observation" => fake()->sentence(6),
                //             "prix" => fake()->fake()->randomFloat(2, 100, 10000),
                //         ]
                //     );
                // } catch (\Throwable $th) {
                //     //throw $th;
                // }
            }
        }
    }
}
