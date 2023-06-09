<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BonSortie;
use App\Models\Categorie;
use App\Models\Inventaire;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //$this->call(RoleSeeder::class);
        
        $this->call(PermissionSeeder::class);
        $this->call(AdminSeeder::class);

        $this->call(DocumentSeeder::class);
        $this->call(UniteSeeder::class);
        $this->call(TypeArticleSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(TypeCommandeSeeder::class);
        
        //$this->call(ArticleSeeder::class);
        
        // $this->call(UserSeeder::class);
        
        // $this->call(InventaireSeeder::class);
        // $this->call(FournisseurSeeder::class);


        

        //$this->call(CommandeSeeder::class);
        //$this->call(FactureSeeder::class);
        //$this->call(LivraisonSeeder::class);

        //$this->call(ReceptionSeeder::class);
        //$this->call(LigneEntreeSeeder::class);

        //$this->call(SortieSeeder::class);
        //$this->call(PriseEnChargeSeeder::class);
        //$this->call(BonSortieSeeder::class);
        //$this->call(ReformeSeeder::class);

    }
}
