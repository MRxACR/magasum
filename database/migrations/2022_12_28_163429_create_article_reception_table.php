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
        Schema::create('article_reception', function (Blueprint $table) {
            $table->foreignId('reception_id')->constrained();
            $table->foreignId('article_id')->constrained('articles','id_art');
            $table->bigInteger('id');
            $table->decimal('prix',15,2,true);
            $table->integer("quantity",false,true)->default(1);
            $table->string('n_inventaire')->nullable()->unique();
            $table->string('n_reception')->nullable()->unique();
            $table->primary(['reception_id','article_id','id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_reception');
    }
};
