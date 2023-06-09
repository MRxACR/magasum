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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id_art');
            $table->string('desg_art');
            $table->string('nsr_art')->nullable();
            $table->string('n_inventaire')->nullable();
            $table->decimal("qte_init",8,0,true)->default(1);
            $table->decimal("qte_stock",8,0,true)->default(0);
            $table->decimal("qte_alt",8,0,true)->default(1);
            $table->decimal('prix',15,2,true)->nullable();
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
        Schema::dropIfExists('articles');
    }
};
