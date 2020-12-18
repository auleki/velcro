<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
		    $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('phone_no')->nullable();            
            $table->enum('permission', array('view', 'edit', 'admin'))->default('admin')->nullable();
            $table->rememberToken();
			$table->timestamps();
		});

		/**
		*Create dummy users
		* remove this from production
		*
		**/

		DB::table('users')->insert(array(
            'fname' => 'Super',
            'lname' => 'Admin',
            // 'type' => 'echovc',
            // 'avatar' => 'avatar.png',
            'email' => 'admin@echovc.com',
            'email_verified_at' => Carbon::now(),
            'password' =>  Hash::make('password'),
            'permission' => 'admin',
            //$2y$10$7c/JJ6v8qgHKmITv1fC1KuYeDyY8fsoUhqpHvWAoaveFQsFwbncj6
        ));

        // $avatar = Avatar::create($user['fname'] .''. $user['lname'])->getImageObject()->encode('png');
        // Storage::put('/public/avatars/'.$user->id.'/avatar.png', (string) $avatar);

       //  DB::table('users')->insert(array(
       //      'name' => 'Teacher',
       //      'role' => 'teacher',
       //      'email' => 'teacher@domain.com',
       //      'password' =>  Hash::make('password'),
       // ));
	}

	public function down()
	{
		 Schema::dropIfExists('users');
	}
}