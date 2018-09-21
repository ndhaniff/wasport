<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medals', function (Blueprint $table) {
            $table->increments('mid');
            $table->string('name');
            $table->string('medal_grey')->nullable();
            $table->string('medal_color')->nullable();
            $table->string('cert')->nullable();
            $table->string('bib')->nullable();
            $table->integer('races_id')->unsigned();
            $table->foreign('races_id')->references('rid')->on('races')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('medals');
    }
}
