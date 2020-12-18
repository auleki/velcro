<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration {

	public function up()
	{
		Schema::create('notes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('content')->nullable();
			$table->bigInteger('company_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('notes');
	}
}
