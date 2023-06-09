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
        Schema::create('article_inventaire', function (Blueprint $table) {
            $table->foreignId('inventaire_id')->constrained();
            $table->foreignId('article_id')->constrained('articles','id_art');
            $table->decimal('prix',15,2,true)->nullable();
            $table->integer("quantity",false,true)->default(1);
            $table->string('n_inventaire')->nullable();
            $table->string('n_referance')->nullable();
            $table->primary(['inventaire_id','article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_inventaire');
    }
};
