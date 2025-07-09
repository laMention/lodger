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
        Schema::create('point_forts', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('libelle_point_fort');
            $table->tinyinteger('etat')->default(true);
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
        Schema::dropIfExists('point_forts');
    }
};
