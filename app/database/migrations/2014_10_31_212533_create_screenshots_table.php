<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScreenshotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('screenshots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('url');
			$table->integer('report_id');
			$table->string('os');
			$table->string('os_version');
			$table->string('browser');
			$table->string('browser_version');
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
		Schema::drop('screenshots');
	}

}
