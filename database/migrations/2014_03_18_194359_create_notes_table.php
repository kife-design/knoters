<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration {

	public function up()
	{
		Schema::create('notes', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('index')->unsigned();
            $table->string('key', 100);
			$table->integer('upload_id')->unsigned();
			$table->integer('asset_id')->unsigned();
			$table->integer('from_id')->unsigned();
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