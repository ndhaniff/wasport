<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfflinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offlines', function (Blueprint $table) {
            $table->increments('fid');
            $table->string('title_en');
            $table->string('title_ms')->nullable();
            $table->string('title_zh')->nullable();
            $table->string('date')->nullable();
            $table->string('category')->nullable();
            $table->string('state')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->longText('details_en')->nullable();
            $table->longText('details_ms')->nullable();
            $table->longText('details_zh')->nullable();
            $table->string('raceimg_1')->nullable();
            $table->string('raceimg_2')->nullable();
            $table->string('raceimg_3')->nullable();
            $table->string('raceimg_4')->nullable();
            $table->string('raceimg_5')->nullable();
            $table->string('raceimg_6')->nullable();
            $table->string('header')->nullable();
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
        Schema::dropIfExists('offlines');
    }
}
