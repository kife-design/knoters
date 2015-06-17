<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailsTable extends Migration {

	public function up()
	{
		Schema::create('emails', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email', 255);
			$table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('emails');
	}
}