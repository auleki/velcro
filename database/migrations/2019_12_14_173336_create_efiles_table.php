<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEfilesTable extends Migration {

	public function up()
	{
		Schema::create('efiles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('size')->nullable();
			$table->string('type')->nullable();
			$table->string('path')->nullable();
			$table->string('storage')->nullable();
			$table->enum('status', array('active', 'archive'))->nullable();
			$table->string('source')->nullable();
			$table->bigInteger('company_id')->unsigned()->nullable();
			$table->bigInteger('user_id')->unsigned()->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('efiles');
	}
}
