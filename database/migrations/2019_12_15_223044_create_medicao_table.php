<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sensor_id')->foreign('sensor_id')->references('id')->on('sensor');
            $table->integer('valor');
            $table->dateTime('data_horario');
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
        Schema::dropIfExists('medicao');
    }
}
