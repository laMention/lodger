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
        Schema::table('appartements', function (Blueprint $table) {
            $table->string('ville')->nullable();
            $table->string('commune')->nullable();
            $table->string('rue')->nullable();
            $table->string('quartier')->nullable();
            $table->string('type_immobilier')->nullable();
            $table->integer('meuble')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appartements', function (Blueprint $table) {
            Schema::dropIfExists('ville');
            Schema::dropIfExists('commune');
            Schema::dropIfExists('rue');
            Schema::dropIfExists('quartier');
            Schema::dropIfExists('type_immobilier');
            Schema::dropIfExists('meuble');
        });
    }
};
