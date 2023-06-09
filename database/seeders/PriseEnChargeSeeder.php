<?php

namespace Database\Seeders;

use App\Models\PriseEnCharge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriseEnChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriseEnCharge::factory(5)->create();
    }
}
