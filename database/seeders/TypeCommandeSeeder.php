<?php

namespace Database\Seeders;

use App\Models\TypeCommande;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCommande::create([
            "desg" => "travaux",
        ]);
        TypeCommande::create([
            "desg" => "fournitures",
        ]);
        TypeCommande::create([
            "desg" => "services",
        ]);
        TypeCommande::create([
            "desg" => "dépenses",
        ]);
        TypeCommande::create([
            "desg" => "dépenses d'équipement",
        ]);
        TypeCommande::create([
            "desg" => "autre",
        ]);
    }
}
