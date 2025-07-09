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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('reference');
            $table->string('lastname')->nullable();
            $table->string('date_naissance')->nullable();
            $table->integer('role');
            $table->string('contact');
            $table->string('contact_fixe')->nullable();
            $table->string('photo');
            $table->string('num_cni')->nullable();
            $table->string('adresse')->nullable();
            $table->string('sexe')->nullable();
            $table->integer('ville_id');
            $table->integer('pays_id');
            $table->string('photo_cni')->nullable();
            $table->string('localisation')->nullable();
            $table->text('description')->nullable();
            $table->tinyinteger('etat')->default(false);
            $table->tinyinteger('deleted')->default(false);

            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
