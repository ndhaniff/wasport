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
            $table->increments('id');
            $table->string('title');
            $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('dead_from')->nullable();
            $table->string('dead_to')->nullable();
            $table->string('price')->nullable();
            $table->longText('about')->nullable();
            $table->longText('awards')->nullable();
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
