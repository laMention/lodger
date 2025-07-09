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
        Schema::create('avance_loyers', function (Blueprint $table) {
            $table->id();
             $table->integer('appartement_id');
            $table->string('reference');
            $table->integer('montant');
            $table->string('devise')->nullable();
            $table->string('periode')->nullable();
            $table->integer('description')->nullable();
            $table->tinyinteger('etat')->default(false);
            $table->tinyinteger('deleted')->default(false);
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
        Schema::dropIfExists('avance_loyers');
    }
};
