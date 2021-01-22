<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('appointmentId')->unsigned();
            $table->foreign('appointmentId')->references('id')->on('appointment')->onDelete('cascade');
            $table->bigInteger('userId')->unsigned();
            $table->foreign('userId')->references('id')->on('user')->onDelete('cascade');
            $table->bigInteger('moneyChangerId')->unsigned();
            $table->foreign('moneyChangerId')->references('id')->on('money_changer')->onDelete('cascade');
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
        Schema::dropIfExists('appointment_detail');
    }
}
