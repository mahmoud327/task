<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class  extends Migration {

	public function up()
	{
		Schema::create('areas', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('', 255)->unique();
			$table->double('cost');

		});


	}

	public function down()
	{
		Schema::drop('areas');
	}
};
