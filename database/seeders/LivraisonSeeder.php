<?php

namespace Database\Seeders;

use App\Models\Livraison;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LivraisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Livraison::factory(50)->create();
    }
}
