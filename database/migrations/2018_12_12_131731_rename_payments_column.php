<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePaymentsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('payments', function(Blueprint $table) {
          $table->renameColumn('payment_status', 'p_status');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('payments', function(Blueprint $table) {
          $table->renameColumn('p_status', 'payment_status');
      });
    }
}
