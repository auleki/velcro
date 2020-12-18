<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_funds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('fund_id');
            $table->string('committed_currency')->nullable();
            $table->string('committed')->nullable();
            $table->string('round');
            $table->string('shares')->nullable();
            $table->string('percent_owned')->nullable();
            $table->string('round_size')->nullable();
            $table->string('round_size_currency')->nullable();
            $table->string('next_round_timeline')->nullable();
            $table->string('forecast_echovc_inv')->nullable();
            $table->string('forecast_echovc_inv_currency')->nullable();
            $table->string('investors_in_seed')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('fund_id')->references('id')->on('funds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_funds');
    }
}
