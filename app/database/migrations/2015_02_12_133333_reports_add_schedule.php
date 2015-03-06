<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReportsAddSchedule extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //add a default for schedule to default ti current dateTime
        Schema::table('reports', function($table)
        {
            $table->timestamp('schedule')->default(DB::raw('CURRENT_TIMESTAMP'));;
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        //
        Schema::table('reports', function($table)
        {
            $table->dropColumn('schedule');
        });


	}

}
