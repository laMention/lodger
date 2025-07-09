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
        Schema::create('paiement_loyers', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->integer('facture_id');
            $table->integer('user_id');
            $table->integer('appartement_id');
            $table->integer('agence_id');
            $table->integer('montant')->default(0);
            $table->integer('status');
            $table->text('description')->nullable();
            $table->string('passerelle')->nullable();
            $table->datetime('date_paiement');
            $table->string('status_transaction')->nullable();
            $table->string('devise')->nullable();
            $table->integer('moyen_paiement_id');
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
        Schema::dropIfExists('paiement_loyers');
    }
};
