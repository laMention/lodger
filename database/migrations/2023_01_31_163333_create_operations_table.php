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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('agence_id');
            $table->string('designation')->nullable();
            $table->text('description')->nullable();
            $table->datetime('date_operation')->nullable();
            $table->integer('type_operation');
            $table->integer('montant')->default(0);
            $table->text('remarque')->nullable();
            $table->tinyinteger('etat')->default(true);
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
        Schema::dropIfExists('operations');
    }
};
