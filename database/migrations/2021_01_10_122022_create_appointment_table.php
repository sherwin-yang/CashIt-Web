<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('orderNumber');
            $table->string('status');
            $table->date('date');
            $table->time('time');
            $table->integer('toExchangeAmount');
            $table->integer('toReceiveAmount');
            $table->string('toExchangeCurrencyName');
            $table->string('toReceiveCurrencyName');
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
        Schema::dropIfExists('appointment');
    }
}
