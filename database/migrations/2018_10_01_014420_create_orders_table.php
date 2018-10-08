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
            $table->string('o_firstname');
            $table->string('o_lastname');
            $table->string('o_birthday');
            $table->string('o_phone');
            $table->string('o_gender');
            $table->string('o_add_fl');
            $table->string('o_add_sl');
            $table->string('o_city');
            $table->string('o_state');
            $table->string('o_postal');
            $table->string('race_category')->nullable();
            $table->string('engrave_name')->nullable();
            $table->string('o_addon')->nullable();
            $table->string('race_status');
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
