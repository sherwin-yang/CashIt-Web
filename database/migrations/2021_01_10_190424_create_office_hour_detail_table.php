<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeHourDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_hour_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('officeHourId')->unsigned();
            $table->foreign('officeHourId')->references('id')->on('office_hour')->onDelete('cascade');
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
        Schema::dropIfExists('office_hour_detail');
    }
}
