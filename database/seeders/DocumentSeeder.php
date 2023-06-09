<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::create([
            "titre" => "bon de sortie",
            "heading" => '<p class="h3 text-uppercase"><strong>ministre de l\'enseignement supérieur <br>et de la recherche
            scientifique</strong></p>
            <p class="h4 text-capitalize"><strong>Université Mouloud Mammeri de Tizi-Ouzou</strong></p>
            <p class="h4 text-capitalize"><strong>Sous direction des finances et moyens</strong></p>
            <p class="h4 text-capitalize"><strong>Service des moyens généraux</strong></p>',
            "subheading" => '',
            "logo" => '',
            "police" => "font-monospace",
        ]);

        Document::create([
            "titre" => "prise en charge",
            "heading" => '<p class="h3 text-uppercase fw-bold">ministre de l\'enseignement supérieur <br>et de la recherche
                scientifique</p>
                <p class="h3 text-capitalize fw-bold">Université Mouloud Mammeri de Tizi-Ouzou</p>',
            "subheading" => '',
            "logo" => '',
            "police" => "font-monospace",
        ]);

        Document::create([
            "titre" => "réforme du matériel",
            "heading" => '<p class="h3 text-uppercase fw-bold">ministre de l\'enseignement supérieur <br>et de la recherche
                scientifique</p>
                <p class="h3 text-capitalize fw-bold">Université Mouloud Mammeri de Tizi-Ouzou</p>',
            "subheading" => '<div class="col-sm-4 text-sm-start text-center fs-3">
                    <p>Préparé par: ...................</p>
                    </div><div class="col-sm-4 text-sm-center text-center fs-3">
                        <p>Revu par: ....................</p>
                    </div><div class="col-sm-4 text-sm-end text-center fs-3">
                        <p>Approuvé par: ...................</p>
                    </div>',
            "logo" => '',
            "police" => "font-monospace",
        ]);

        Document::create([
            "titre" => "fiche d'inventaire d'équipements",
            "heading" => '<p class="h3 text-uppercase fw-bold">ministre de l\'enseignement supérieur <br>et de la recherche
                scientifique</p>
                <p class="h3 text-capi
                talize fw-bold">Université Mouloud Mammeri de Tizi-Ouzou</p>',
            "subheading" => '<div class="col-sm-4 text-sm-start text-center fs-3">
                    <p>Préparé par: ...................</p>
                    </div><div class="col-sm-4 text-sm-center text-center fs-3">
                        <p>Revu par: ....................</p>
                    </div><div class="col-sm-4 text-sm-end text-center fs-3">
                        <p>Approuvé par: ...................</p>
                    </div>',
            "logo" => '',
            "police" => "font-monospace",
        ]);
        Document::create([
            "titre" => "bon de commande",
            "heading" => '<p class="h3 text-uppercase fw-bold">ministre de l\'enseignement supérieur <br>et de la recherche
                scientifique</p>
                <p class="h3 text-capitalize fw-bold">Université Mouloud Mammeri de Tizi-Ouzou</p>',
            "subheading" => '<div class="col-sm-4 text-sm-start text-center fs-3">
                    <p>Préparé par: ...................</p>
                    </div><div class="col-sm-4 text-sm-center text-center fs-3">
                        <p>Revu par: ....................</p>
                    </div><div class="col-sm-4 text-sm-end text-center fs-3">
                        <p>Approuvé par: ...................</p>
                    </div>',
            "logo" => '',
            "police" => "font-monospace",
        ]);
        Document::create([
            "titre" => "fiche de stock",
            "heading" => '<p class="h3 text-uppercase fw-bold">ministre de l\'enseignement supérieur <br>et de la recherche
                scientifique</p>
                <p class="h3 text-capitalize fw-bold">Université Mouloud Mammeri de Tizi-Ouzou</p>',
            "subheading" => '<div class="col-sm-4 text-sm-start text-center fs-3">
                    <p>Préparé par: ...................</p>
                    </div><div class="col-sm-4 text-sm-center text-center fs-3">
                        <p>Revu par: ....................</p>
                    </div><div class="col-sm-4 text-sm-end text-center fs-3">
                        <p>Approuvé par: ...................</p>
                    </div>',
            "logo" => '',
            "police" => "font-monospace",
        ]);
        Document::create([
            "titre" => "bon de réception",
            "heading" => '<p class="h3 text-uppercase fw-bold">ministre de l\'enseignement supérieur <br>et de la recherche
                scientifique</p>
                <p class="h3 text-capitalize fw-bold">Université Mouloud Mammeri de Tizi-Ouzou</p>',
            "subheading" => '<div class="col-sm-4 text-sm-start text-center fs-3">
                    <p>Préparé par: ...................</p>
                    </div><div class="col-sm-4 text-sm-center text-center fs-3">
                        <p>Revu par: ....................</p>
                    </div><div class="col-sm-4 text-sm-end text-center fs-3">
                        <p>Approuvé par: ...................</p>
                    </div>',
            "logo" => '',
            "police" => "font-monospace",
        ]);
    }
}
