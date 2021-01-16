<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyChangerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_changer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('moneyChangerName');
            $table->string('password');
            $table->string('email')->unique();
            $table->binary('photo');
            $table->string('address');
            $table->string('whatsAppNumber');
            $table->string('phoneNumber');
            $table->string('latitudeCoordinate')->nullable();
            $table->string('longitudeCoordinate')->nullable();
            $table->boolean('isActivated');
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
        Schema::dropIfExists('money_changer');
    }
}
