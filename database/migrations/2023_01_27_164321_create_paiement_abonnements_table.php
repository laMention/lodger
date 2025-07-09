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
        Schema::create('paiement_abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->integer('user_id')->nullable();
            $table->integer('agence_id');
            $table->integer('abonnement_id');
            $table->float('montant_paiement')->default(0);
            $table->string('mode_paiement')->nullable();
            $table->string('account')->nullable();
            $table->string('source')->nullable();
            $table->string('channel')->nullable();
            $table->string('currency')->nullable();
            $table->string('date_payment')->nullable();
            $table->string('country_code')->nullable();
            $table->string('entTransaction_id')->nullable();
            $table->string('extTransaction_id')->nullable();
            $table->string('statut')->nullable();
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
        Schema::dropIfExists('paiement_abonnements');
    }
};
