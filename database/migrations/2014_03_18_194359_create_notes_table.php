<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration {

	public function up()
	{
		Schema::create('notes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('uuid', 36);
            $table->integer('index')->unsigned();
			$table->integer('project_id')->unsigned();
			$table->integer('from_id')->unsigned();
			$table->integer('note_type_id')->unsigned();
			$table->text('message')->nullable();
			$table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('notes');
	}
}