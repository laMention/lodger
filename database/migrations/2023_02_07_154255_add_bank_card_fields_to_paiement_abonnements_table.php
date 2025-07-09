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
        Schema::table('paiement_abonnements', function (Blueprint $table) {
            $table->integer('annee_expiration_carte')->nullable();
            $table->integer('mois_expiration_carte')->nullable();
            $table->integer('cvc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement_abonnements', function (Blueprint $table) {
            $table->dropColumn('annee_expiration_carte');
            $table->dropColumn('mois_expiration_carte');
            $table->dropColumn('cvc');
        });
    }
};
