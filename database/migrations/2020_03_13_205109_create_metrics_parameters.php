<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricsParameters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('metric');
            $table->boolean('gross_profit')->default(0);
            $table->boolean('net_income')->default(0);
            $table->boolean('revenue')->default(0);
            $table->boolean('total_assets')->default(0);
            $table->boolean('total_cash')->default(0);
            $table->boolean('total_cost_of_sales')->default(0);
            $table->boolean('total_equity')->default(0);
            $table->boolean('total_expenses')->default(0);
            $table->boolean('total_liabilities')->default(0);
            $table->boolean('total_property')->default(0);
            $table->tinyInteger('organizations')->default(0);
            $table->tinyInteger('members')->default(0);
            $table->tinyInteger('boards')->default(0);
            $table->tinyInteger('cards')->default(0);
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
        Schema::dropIfExists('metrics_parameters');
    }
}
