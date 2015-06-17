<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrafficTable extends Migration {

	public function up()
	{
		Schema::create('traffic', function(Blueprint $table) {
			$table->increments('id');
			$table->string('key', 100);
			$table->integer('upload_id')->unsigned();
			$table->integer('from_id')->unsigned()->nullable();
			$table->integer('to_id')->unsigned();
			$table->text('message')->nullable();
			$table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('traffic');
	}
}