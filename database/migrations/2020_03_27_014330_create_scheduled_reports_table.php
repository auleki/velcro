<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('report_id');
            $table->string('report_title');
            $table->string('content');
            $table->string('message');
            $table->string('type');
            $table->string('recipients');
            $table->string('status');
            $table->string('schedule');
            $table->string('date')->nullable();
            $table->string('hour')->nullable();
            $table->string('minute')->nullable();
            $table->string('period')->nullable();
            $table->string('selected_day')->nullable();
            $table->string('recurring')->nullable();
            $table->string('last_send')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheduled_reports');
    }
}
