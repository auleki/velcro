<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDashboardsTable extends Migration {

	public function up()
	{
		Schema::create('dashboards', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('company_id')->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('dashboards');
	}
}
