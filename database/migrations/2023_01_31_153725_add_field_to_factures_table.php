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
        Schema::table('factures', function (Blueprint $table) {
            //
            $table->integer('locataire_id')->nullable();
            $table->datetime('date_echeance')->nullable();
            $table->datetime('next_date_echeance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factures', function (Blueprint $table) {
            //
             Schema::dropIfExists('locataire_id');
             Schema::dropIfExists('date_echeance');
             Schema::dropIfExists('next_date_echeance');
        });
    }
};
