<?php

namespace Database\Seeders;

use App\Models\TypeArticle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TypeArticle::create([
            "desg" => "consommable"
        ]);

        TypeArticle::create([
            "desg" => "inventoriable"
        ]);
    }
}
