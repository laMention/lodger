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
        Schema::create('historique_locations', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('locataire_id');
            $table->string('appartement_id');
            $table->string('agence_id');
            $table->datetime('date_location')->nullable();
            $table->datetime('date_resiliation')->nullable();
            $table->tinyinteger('etat')->default(true);
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
        Schema::dropIfExists('historique_locations');
    }
};
