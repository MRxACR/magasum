<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\TypeArticle;
use App\Models\Unite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory(50)->create();
    }
}
