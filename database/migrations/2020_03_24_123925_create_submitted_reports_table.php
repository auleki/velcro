<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('received_report_id')->nullable();
            $table->string('request_type')->nullable();
            $table->bigInteger('request_id')->nullable();
            $table->bigInteger('kpi_id')->nullable();
            $table->string('response')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submitted_reports');
    }
}
