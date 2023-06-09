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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->string('num');
            $table->foreignId("facture_id")->constrained();
            $table->foreignId("livraison_id")->constrained();
            $table->foreignId("document_id")->default(7)->constrained();
            $table->date('date')->default(now());
            $table->string('num_marche')->nullable();
            $table->string('num_consultation')->nullable();
            $table->string('num_ods')->nullable();
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
        Schema::dropIfExists('receptions');
    }
};
