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
        Schema::create('appartements', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('code_appart')->nullable();
            $table->integer('user_id');
            $table->integer('proprietaire_id');
            $table->integer('agence_id');
            $table->string('categorie');
            $table->string('libelle');
            $table->string('niveau')->nullable();
            $table->string('adresse')->nullable();
            $table->string('pays_id')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('nb_chambre')->nullable();
            $table->integer('montant_loyer');
            $table->tinyinteger('etat')->default(false);
            $table->tinyinteger('deleted')->default(false);
            $table->tinyinteger('archived')->default(false);
            // $table->integer('caution_id');
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
        Schema::dropIfExists('appartements');
    }
};
