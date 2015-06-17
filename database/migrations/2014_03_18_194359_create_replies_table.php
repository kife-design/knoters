<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepliesTable extends Migration {

	public function up()
	{
		Schema::create('replies', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('index')->unsigned();
			$table->integer('note_id')->unsigned();
			$table->integer('from_id')->unsigned();
			$table->text('message')->nullable();
			$table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('replies');
	}
}