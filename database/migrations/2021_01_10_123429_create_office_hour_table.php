<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeHourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_hour', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day');
            $table->string('status');
            $table->time('openTime');
            $table->time('closeTime');
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
        Schema::dropIfExists('office_hour');
    }
}
