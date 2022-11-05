<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class  extends Migration {

	public function up()
	{
		Schema::create('bills', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->enum('coding_type',['automatic','manual'])->default('automatic');
			$table->text('bill_code')->unique();
			$table->double('weight')->nullable();
			$table->string('number_of_pieces')->unique();
			$table->text('statement')->nullable();
			$table->text('note')->nullable();
			$table->double('cost');

		});


	}

	public function down()
	{
		Schema::drop('bills');
	}
};
