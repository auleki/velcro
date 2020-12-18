<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundChartMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_chart_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fund_chart_id');
            $table->string('column');
            $table->string('row');
            $table->string('color');
            $table->string('name');
            $table->string('source');
            $table->string('tool');
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
        Schema::dropIfExists('fund_chart_metrics');
    }
}
