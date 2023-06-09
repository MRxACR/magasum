<?php

namespace Database\Seeders;

use App\Models\BonSortie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonSortieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BonSortie::factory(5)->create();
    }
}
