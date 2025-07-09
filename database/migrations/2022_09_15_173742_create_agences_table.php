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
        Schema::create('agences', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('contact_fixe')->nullable();
            $table->string('agrement')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('registre_commerce')->nullable();
            $table->string('code_verification')->nullable();
            $table->string('adresse')->nullable();
            $table->string('photo')->nullable();
            $table->string('localisation')->nullable();
            $table->string('remember_token')->nullable();
            $table->integer('ville_id');
            $table->integer('pays_id');
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
        Schema::dropIfExists('agences');
    }
};
