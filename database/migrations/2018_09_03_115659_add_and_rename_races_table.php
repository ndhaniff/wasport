<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndRenameRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('races', function (Blueprint $table) {
            $table->longText('about_ms')->nullable();
            $table->longText('about_zh')->nullable();
            $table->longText('awards_ms')->nullable();
            $table->longText('awards_zh')->nullable();
            $table->longText('title_ms')->nullable();
            $table->longText('title_zh')->nullable();
            $table->longText('price_ms')->nullable();
            $table->longText('price_zh')->nullable();
            $table->renameColumn('about', 'about_en');
            $table->renameColumn('awards', 'awards_en');
            $table->renameColumn('title', 'title_en');
            $table->renameColumn('price', 'price_en');
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
