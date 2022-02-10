<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function (Blueprint $table) {
			$table->id();
			$table->text('title')->nullable();
			$table->text('company')->nullable();
			$table->text('rodo_1')->nullable();
			$table->text('rodo_2')->nullable();
			$table->text('privace_policy')->nullable();
			$table->text('photo')->nullable();
			$table->text('photo_alt')->nullable();
			$table->text('description')->nullable();
			$table->text('cookies')->nullable();
			$table->text('cookies_button')->nullable();
			$table->text('cookies_privace_button')->nullable();
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
		Schema::dropIfExists('settings');
	}
}
