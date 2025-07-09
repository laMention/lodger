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
        Schema::create('prelevements', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->integer('agence_id')->default(0);
            $table->integer('montant')->nullable();
            $table->string('devise')->nullable();
            $table->integer('moyen_paiement_id')->nullable();
            $table->integer('abonnement_id')->nullable();
            $table->string('passerelle')->nullable();
            $table->string('status')->nullable();
            $table->string('status_transaction')->nullable();
            $table->date('date_prelevement')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('prelevements');
    }
};
