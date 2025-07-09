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
        Schema::create('offre_abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('libelle');
            $table->integer('montant')->default(0);
            $table->string('periode')->default('jour');
            $table->integer('duree');
            $table->string('devise');
            $table->tinyinteger('etat')->default(true);
            $table->tinyinteger('deleted')->default(true);
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
        Schema::dropIfExists('offre_abonnements');
    }
};
