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
        Schema::create('fichier_contrats', function (Blueprint $table) {
            $table->id();
            $table->integer('locataire_id');
            $table->integer('agence_id');
            $table->integer('location_id');
            $table->string('contrat');
            $table->tinyinteger('deleted')->default(false);
            $table->tinyinteger('archived')->default(false);
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
        Schema::dropIfExists('fichier_contrats');
    }
};
