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
        Schema::create('article_catalogue', function (Blueprint $table) {
            $table->foreignId('catalogue_id')->constrained();
            $table->foreignId('article_id')->constrained('articles','id_art');
            $table->decimal('prix',15,2,true)->default(0);
            $table->integer("quantity",false,true)->default(0);
            $table->primary(['catalogue_id','article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_catalogue');
    }
};
