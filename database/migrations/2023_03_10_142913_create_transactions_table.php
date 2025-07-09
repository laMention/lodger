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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable();
            $table->datetime('date_transaction')->nullable();
            $table->float('montant')->nullable();
            $table->float('devise')->nullable();
            $table->string('moyen_paiement')->nullable();
            $table->tinyinteger('etat')->default(false);
            $table->tinyinteger('deleted')->default(false);
            $table->integer('agence_id');
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
        Schema::dropIfExists('transactions');
    }
};
