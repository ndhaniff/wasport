<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addons', function (Blueprint $table) {
          $table->increments('oaid');
          $table->string('a_type');
          $table->integer('order_id')->unsigned();
          $table->foreign('order_id')->references('oid')->on('orders')->onDelete('cascade')->onUpdate('cascade');
          $table->integer('addon_id')->unsigned();
          $table->foreign('addon_id')->references('aid')->on('addons')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('order_addons');
    }
}
