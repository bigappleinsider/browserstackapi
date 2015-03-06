<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrowsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('browsers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('browser');
			$table->string('browser_version');
			$table->string('os_version');
			$table->string('os');
			$table->string('device');
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
		Schema::drop('browsers');
	}

}
