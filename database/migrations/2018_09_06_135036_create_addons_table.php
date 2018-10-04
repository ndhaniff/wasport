<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
          $table->increments('aid');
          $table->string('add_en');
          $table->string('add_ms')->nullable();
          $table->string('add_zh')->nullable();
          $table->longText('desc_en')->nullable();
          $table->longText('desc_ms')->nullable();
          $table->longText('desc_zh')->nullable();
          $table->string('descimg_1')->nullable();
          $table->string('descimg_2')->nullable();
          $table->string('descimg_3')->nullable();
          $table->string('descimg_4')->nullable();
          $table->string('descimg_5')->nullable();
          $table->string('descimg_6')->nullable();
          $table->string('addprice');
          $table->string('type')->nullable();
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
        Schema::dropIfExists('addons');
    }
}
