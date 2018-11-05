<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('sid');
            $table->string('s_routeimg')->nullable();
            $table->string('s_distance')->nullable();
            $table->string('s_hour')->nullable();
            $table->string('s_minute')->nullable();
            $table->string('s_second')->nullable();
            $table->string('strava_activity')->nullable();
            $table->string('s_map_polyline')->nullable();
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('rid')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('race_id')->unsigned();
            $table->foreign('race_id')->references('rid')->on('races')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('submissions');
    }
}
