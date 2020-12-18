<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPerformanceChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_performance_charts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_performance_id');
            $table->string('type');
            $table->string('column')->nullable();
            $table->string('row')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_performance_charts');
    }
}
