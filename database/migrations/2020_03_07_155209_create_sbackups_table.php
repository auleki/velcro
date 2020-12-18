<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sbackups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hour')->nullable();
            $table->string('minute')->nullable();
            $table->string('day')->nullable();
            $table->string('interval')->nullable();
            $table->enum('status', array('0','1'))->nullable()->default('0');
            $table->string('daylight')->nullble();
            $table->integer('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('sbackups');
    }
}
