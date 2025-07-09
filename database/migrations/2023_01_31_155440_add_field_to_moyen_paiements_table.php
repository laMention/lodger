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
        Schema::table('moyen_paiements', function (Blueprint $table) {
            $table->integer('mois_expiration_carte')->nullable();
            $table->integer('paiement_auto')->nullable();
            $table->integer('agence_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moyen_paiements', function (Blueprint $table) {
            Schema::dropIfExists('mois_expiration_carte');
            Schema::dropIfExists('paiement_auto');
            Schema::dropIfExists('agence_id');
            
        });
    }
};
