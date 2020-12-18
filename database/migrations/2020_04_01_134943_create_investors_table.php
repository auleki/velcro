<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('investor');
            $table->string('company_invested');
            $table->string('market_focus');
            $table->string('stage');
            $table->string('ticket_size');
            $table->string('recently_active');
            $table->string('company_discussed');
            $table->string('declined_company');
            $table->string('location');
            $table->string('fund')->nullable();
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
        Schema::dropIfExists('investors');
    }
}
