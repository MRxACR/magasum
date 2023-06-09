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
        Schema::create('article_sortie', function (Blueprint $table) {
            $table->foreignId('sortie_id')->constrained();
            $table->foreignId('article_id')->constrained('articles','id_art');
            $table->decimal('prix',15,2,true)->nullable();
            $table->integer("quantity",false,true)->default(0);
            $table->string('observation')->nullable();
            $table->string('referance')->nullable();
            $table->primary(['sortie_id','article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_sortie');
    }
};
