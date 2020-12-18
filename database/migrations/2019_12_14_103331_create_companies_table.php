<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('c_name');
			$table->string('website')->nullable();
			$table->bigInteger('user_id')->unsigned();
			$table->string('country')->nullable();
			$table->bigInteger('contact_id')->unsigned();
			$table->enum('status', array('open', 'close'));
			$table->enum('stage', array('seed', 'series A', 'series B', 'series C'));
			$table->string('lead')->nullable();
			$table->string('analyst')->nullable();
			$table->string('tags')->nullable();
			$table->string('email')->nullable();
			$table->longText('desc')->nullable();
			$table->string('logo')->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('companies');
	}
}
