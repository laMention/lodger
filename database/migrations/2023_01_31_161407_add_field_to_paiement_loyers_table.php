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
        Schema::table('paiement_loyers', function (Blueprint $table) {
            $table->integer('ref_paiement');
            $table->integer('locataire_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement_loyers', function (Blueprint $table) {
            Schema::dropIfExists('ref_paiement');
            Schema::dropIfExists('locataire_id');
        });
    }
};
