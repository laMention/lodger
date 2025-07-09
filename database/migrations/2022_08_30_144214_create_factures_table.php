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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('periode')->nullable();
            $table->integer('user_id');
            $table->integer('location_id');
            $table->string('fichier');
            $table->string('status');
            $table->integer('agence_id');
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
        Schema::dropIfExists('factures');
    }
};
