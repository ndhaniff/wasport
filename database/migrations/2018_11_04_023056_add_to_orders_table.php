<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->string('routeimg')->nullable();
          $table->string('distance')->nullable();
          $table->string('race_hour')->nullable();
          $table->string('race_minute')->nullable();
          $table->string('race_second')->nullable();
          $table->string('map_polyline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::dropIfExists('orders');
        });
    }
}
