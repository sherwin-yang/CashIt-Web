<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('moneyChangerId')->unsigned();
            $table->foreign('moneyChangerId')->references('id')->on('money_changer')->onDelete('cascade');
            $table->bigInteger('currencyId')->unsigned();
            $table->foreign('currencyId')->references('id')->on('currency')->onDelete('cascade');
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
        Schema::dropIfExists('currency_detail');
    }
}
