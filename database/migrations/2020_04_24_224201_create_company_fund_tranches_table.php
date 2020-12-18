<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFundTranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_fund_tranches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_fund_id');
            $table->string('tranche_currency')->nullable();
            $table->string('tranche_value')->nullable();
            $table->string('tranche_date')->nullable();
            $table->timestamps();
            $table->foreign('company_fund_id')->references('id')->on('company_funds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_fund_tranches');
    }
}
