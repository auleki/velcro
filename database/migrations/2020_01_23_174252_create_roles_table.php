<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('display');
            $table->timestamps();
        });

        DB::table('roles')->insert(array(
            'name' => 'admin',
            'display' => 'Admin',
        ));

        DB::table('roles')->insert(array(
            'name' => 'editor',
            'display' => 'Editor',
        ));

        DB::table('roles')->insert(array(
            'name' => 'viewer',
            'display' => 'Viewer',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
