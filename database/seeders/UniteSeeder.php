<?php

namespace Database\Seeders;

use App\Models\Unite;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unite::create([
            'desg' => "autre",
            'abr' => "~",
        ]);
        Unite::create([
            'desg' => "unité",
            'abr' => "U",
        ]);
        Unite::create([
            'desg' => "paquet",
            'abr' => "Pq",
        ]);
        Unite::create([
            'desg' => "ram",
            'abr' => "Ram",
        ]);
        Unite::create([
            'desg' => "rouleau",
            'abr' => "Rl",
        ]);
        Unite::create([
            'desg' => "boite",
            'abr' => "Bt",
        ]);
        Unite::create([
            'desg' => "mètre",
            'abr' => "M",
        ]);
        Unite::create([
            'desg' => "Mètre carré",
            'abr' => "M²",
        ]);
        Unite::create([
            'desg' => "Kilogramme",
            'abr' => "Kg",
        ]);
    }
}
