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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->integer('user_id');
            $table->integer('appartement_id');
            $table->integer('contrat_id');
            $table->integer('agence_id');
            $table->date('date_location');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('locations');
    }
};
