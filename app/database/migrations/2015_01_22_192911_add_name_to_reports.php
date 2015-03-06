<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameToReports extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::table('reports', function($table)
        {
            $table->string('name');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
    {
        Schema::table('reports', function($table)
        {
            $table->dropColumn('name');
        });
	}

}
