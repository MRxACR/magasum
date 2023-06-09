<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Inventaire;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $nbr_art = random_int(0,Article::all()->count());
        // $nbr_inv = 5;
        
        // for ($i=0; $i < $nbr_inv; $i++) { 
        //     $inventaire = Inventaire::create();
        //     for ($j=1; $j < $nbr_art; $j++) { 
        //         $article = Article::find($j);
        //         $inventaire->articles()->attach($article->id_art, ["quantity" => $article->qte_stock,"prix" => $article->prix, "n_inventaire" => $article->n_inventaire, "n_referance" => $article->nsr_art]);
        //     }
        // }
    }
}
