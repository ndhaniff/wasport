<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->increments('rid');
            $table->string('title_en');
            $table->string('title_ms')->nullable();
            $table->string('title_zh')->nullable();
            $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('dead_from')->nullable();
            $table->string('dead_to')->nullable();
            $table->string('time_from')->nullable();
            $table->string('time_to')->nullable();
            $table->string('deadtime_from')->nullable();
            $table->string('deadtime_to')->nullable();
            $table->string('price')->nullable();
            $table->longText('about_en')->nullable();
            $table->longText('about_ms')->nullable();
            $table->longText('about_zh')->nullable();
            $table->longText('awards_en')->nullable();
            $table->longText('awards_ms')->nullable();
            $table->longText('awards_zh')->nullable();
            $table->string('awardimg_1')->nullable();
            $table->string('awardimg_2')->nullable();
            $table->string('awardimg_3')->nullable();
            $table->string('awardimg_4')->nullable();
            $table->string('awardimg_5')->nullable();
            $table->string('awardimg_6')->nullable();
            $table->longText('medals_en')->nullable();
            $table->longText('medals_ms')->nullable();
            $table->longText('medals_zh')->nullable();
            $table->string('medalimg_1')->nullable();
            $table->string('medalimg_2')->nullable();
            $table->string('medalimg_3')->nullable();
            $table->string('medalimg_4')->nullable();
            $table->string('medalimg_5')->nullable();
            $table->string('medalimg_6')->nullable();
            $table->string('category')->nullable();
            $table->string('engrave')->nullable();
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
        Schema::dropIfExists('races');
    }
}
