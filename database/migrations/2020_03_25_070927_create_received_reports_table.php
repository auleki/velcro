<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipient_id');
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('new');
            $table->string('message')->default('Hi');
            $table->unsignedBigInteger('report_id')->nullable();
            $table->string('report_title')->nullable();
            $table->bigInteger('sent_report_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('recipients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('received_reports');
    }
}
