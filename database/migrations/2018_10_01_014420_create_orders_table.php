<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('oid');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('birthday');
            $table->string('phone');
            $table->string('gender');
            $table->string('add_fl');
            $table->string('add_sl');
            $table->string('city');
            $table->string('state');
            $table->string('postal');
            $table->string('category')->nullable();
            $table->string('engraving')->nullable();
            $table->string('addon')->nullable();
            $table->string('status');
            $table->string('shipment')->nullable();
            $table->string('tracking number')->nullable();
            $table->integer('races_id')->unsigned();
            $table->foreign('races_id')->references('rid')->on('races')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('addons_id')->unsigned();
            $table->foreign('addons_id')->references('aid')->on('addons')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('orders');
    }
}
