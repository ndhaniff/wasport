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
            $table->string('title_ms');
            $table->string('title_zh');
            $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('dead_from')->nullable();
            $table->string('dead_to')->nullable();
            $table->string('price')->nullable();
            $table->longText('about_en')->nullable();
            $table->longText('about_ms')->nullable();
            $table->longText('about_zh')->nullable();
            $table->longText('awards_en')->nullable();
            $table->longText('awards_ms')->nullable();
            $table->longText('awards_zh')->nullable();
            $table->longText('medals_en')->nullable();
            $table->longText('medals_ms')->nullable();
            $table->longText('medals_zh')->nullable();
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
