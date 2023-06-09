<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create([
            "desg" => "autre",
        ]);
        Categorie::create([
            "desg" => "matériel informatique",
        ]);
        Categorie::create([
            "desg" => "matériel bureautique",
        ]);
        Categorie::create([
            "desg" => "meuble bureautique",
        ]);
        Categorie::create([
            "desg" => "matériel médical",
        ]);
        Categorie::create([
            "desg" => "matériel électrique",
        ]);
        Categorie::create([
            "desg" => "matériel de plomberie",
        ]);
        Categorie::create([
            "desg" => "materiel de peinture",
        ]);
        Categorie::create([
            "desg" => "matériel de nettoyage",
        ]);
        Categorie::create([
            "desg" => "habillement de travail",
        ]);
        Categorie::create([
            "desg" => "materiel électroménagers",
        ]);
    }
}
