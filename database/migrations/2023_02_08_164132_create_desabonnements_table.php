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
        Schema::create('desabonnements', function (Blueprint $table) {
            $table->id();
            $table->integer('agence_id');
            $table->integer('abonnement_id');
            $table->dateTime('date_desabonnement');
            $table->integer('etat')->default(false);
            $table->integer('deleted')->default(false);
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
        Schema::dropIfExists('desabonnements');
    }
};
