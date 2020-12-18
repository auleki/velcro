<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetColumnRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_column_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('spreadsheet');
            $table->string('sheet_id');
            $table->string('date_row');
            $table->string('metric_column');
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
        Schema::dropIfExists('sheet_column_rows');
    }
}
