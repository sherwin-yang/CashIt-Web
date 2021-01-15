<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('moneyChangerId')->unsigned();
            $table->foreign('moneyChangerId')->references('id')->on('money_changer')->onDelete('cascade');
            $table->bigInteger('adminId')->unsigned();
            $table->foreign('adminId')->references('id')->on('admin')->onDelete('cascade');
            $table->string('revisionNote');
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
        Schema::dropIfExists('revision');
    }
}
