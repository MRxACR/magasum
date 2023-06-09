<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('num')->unique()->nullable();
            $table->date("date")->default(now());
            $table->string('denomination')->nullable();
            $table->string('code')->nullable();
            $table->text("adresse")->nullable();
            $table->string('telephone')->nullable();
            $table->string('fix')->nullable();
            $table->text("object")->nullable();

            $table->foreignId("catalogue_id")->constrained();
            $table->foreignId("fournisseur_id")->constrained();
            $table->foreignId("type_commande_id")->constrained();
            $table->foreignId("document_id")->constrained()->default(5);

            
            //type_commandes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};
