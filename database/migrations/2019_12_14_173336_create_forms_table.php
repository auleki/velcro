<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormsTable extends Migration {

	public function up()
	{
		Schema::create('forms', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('report_id')->unsigned();
			$table->string('type')->nullable();
			$table->string('key')->nullable();
			$table->string('value')->nullable();
			$table->boolean('required');
			$table->timestamps();
			$table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('forms');
	}
}
