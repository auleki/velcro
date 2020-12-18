<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('report_id');
            $table->bigInteger('contact_id')->unsigned();
            $table->string('status')->default('Not Viewed');
            $table->bigInteger('number_of_times_opened')->default(0);
            $table->timestamp('time_viewed')->nullable();
            $table->boolean('opened')->default(false);
            $table->boolean('delivered')->default(false);
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipients');
    }
}
