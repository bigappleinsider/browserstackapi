<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrowsersTableAddEnabledCol extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('browsers', function($table)
        {
            $table->boolean('enabled')->default(false);;
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('browsers', function($table)
        {
            $table->dropColumn('enabled');
        });


	}

}
