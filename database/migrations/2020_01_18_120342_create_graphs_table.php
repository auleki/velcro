<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graphs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Date');
            $table->string('Revenue')->nullable();
            $table->string('CostOfGoodsSold')->nullable();
            $table->string('GrossProfit')->nullable();
            $table->string('Payroll')->nullable();
            $table->string('Contactors')->nullable();
            $table->string('MarketingExpenses')->nullable();
            $table->string('OfficeRentAndExpenses')->nullable();
            $table->string('WebServicesAndUtilities')->nullable();
            $table->string('TravelAndEntertainment')->nullable();
            $table->string('TotalExpenses')->nullable();
            $table->string('NetIncome')->nullable();
            $table->string('CashOnHand')->nullable();
            $table->string('MonthsOfRunway')->nullable();
            $table->bigInteger('ProductKPI1')->unsigned()->nullable();
            $table->bigInteger('ProductKPI2')->unsigned()->nullable();
            $table->bigInteger('ProductKPI3')->unsigned()->nullable();
            $table->bigInteger('MarketingKPI1')->unsigned()->nullable();
            $table->bigInteger('MarketingKPI2')->unsigned()->nullable();
            $table->bigInteger('MarketingKPI3')->unsigned()->nullable();
            $table->bigInteger('SalesKPI1')->unsigned()->nullable();
            $table->bigInteger('SalesKPI2')->unsigned()->nullable();
            $table->bigInteger('SalesKPI3')->unsigned()->nullable();
            $table->bigInteger('CustomerSuccessKPI1')->unsigned()->nullable();
            $table->bigInteger('CustomerSuccessKPI2')->unsigned()->nullable();
            $table->bigInteger('CustomerSuccessKPI3')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('sheet_name')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graphs');
    }
}
