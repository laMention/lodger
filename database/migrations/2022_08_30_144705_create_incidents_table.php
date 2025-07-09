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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('sujet');
            $table->text('description');
            $table->string('status');
            $table->integer('appartement_id');
            $table->integer('user_id');
            $table->integer('agence_id');
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
        Schema::dropIfExists('incidents');
    }
};
