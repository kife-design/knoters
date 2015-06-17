<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNoteParametersTable extends Migration {

	public function up()
	{
		Schema::create('note_parameters', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('note_id')->unsigned();
			$table->string('name', 250);
			$table->string('value', 250);
			$table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('note_parameters');
	}
}