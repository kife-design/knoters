<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetParametersTable extends Migration {

	public function up()
	{
		Schema::create('asset_parameters', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 250);
			$table->string('value', 250);
			$table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('asset_parameters');
	}
}