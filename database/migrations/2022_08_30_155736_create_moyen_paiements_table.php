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
        Schema::create('moyen_paiements', function (Blueprint $table) {
            $table->id();
            
            $table->string('reference');
            $table->integer('user_id');
            $table->integer('type_user')->nullable();
            $table->text('description')->nullable();
            $table->string('compte')->nullable();
            $table->string('type_paiement')->nullable();
            $table->date('date_expiration')->nullable();
            $table->integer('defaut')->nullable();
            $table->integer('cvc')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('moyen_paiements');
    }
};
