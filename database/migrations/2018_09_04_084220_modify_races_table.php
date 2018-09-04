<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('races', function (Blueprint $table) {
          $table->longText('medals_en')->nullable();
          $table->renameColumn('price_zh', 'medals_zh');
          $table->renameColumn('price_ms', 'medals_ms');
          $table->renameColumn('price_en', 'price');
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
