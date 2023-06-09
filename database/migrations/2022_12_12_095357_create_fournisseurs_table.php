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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id('id');
            
            $table->string('nom');
            $table->string('prenom');
            $table->string('rs')->unique()->nullable();
            $table->string('tel')->unique()->nullable();
            $table->string('fax')->unique()->nullable();
            $table->string('adr')->nullable();
            $table->string('willaya')->nullable();

            $table->string('rc')->unique()->nullable();
            $table->string('ai')->unique()->nullable();
            $table->string('mf')->unique()->nullable();

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
        Schema::dropIfExists('fournisseurs');
    }
};
