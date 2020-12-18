<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsTable extends Migration
{

	public function up()
	{
		Schema::create('charts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->enum('type', array('column', 'bar', 'funnel', 'pie', 'spline'))->nullable();
			$table->string('investment')->nullable();
			$table->string('exit')->nullable();
			$table->unsignedBigInteger('metric_id')->unsigned();
			$table->unsignedBigInteger('dashboard_id')->unsigned();
			$table->unsignedBigInteger('company_id')->unsigned();
			$table->timestamps();
			$table->foreign('metric_id')->references('id')->on('metrics')->onDelete('cascade');
			$table->foreign('dashboard_id')->references('id')->on('dashboards')->onDelete('cascade');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('charts');
	}
}
