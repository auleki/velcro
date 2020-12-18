<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetricsTable extends Migration
{

	public function up()
	{
		Schema::create('metrics', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->nullable();
			$table->string('tool_id')->nullable();
			$table->string('column_name')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('metrics');
	}
}
