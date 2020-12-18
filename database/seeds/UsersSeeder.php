<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();
        $users = [
            'jude@gmail.com' => [
                'password' => 'password',
                'phone' => '08012345678',
                'dob' => '1994-12-12',
                'is_executive' => 0
            ],
            'buyer1@gmail.com' => [
                'password' => 'password',
                'phone' => '08012345674',
                'dob' => '1994-12-12',
                'is_executive' => 0
            ],
            'mohd@gmail.com' => [
                'password' => 'password',
                'phone' => '08012345671',
                'dob' => '1994-12-12',
                'is_executive' => 1
            ],
            'tinubu@gmail.com' => [
                'password' => 'password',
                'phone' => '08012345673',
                'dob' => '1994-12-12',
                'is_executive' => 1
            ],
            'dino@gmail.com' => [
                'password' => 'password',
                'phone' => '08012345672',
                'dob' => '1994-12-12',
                'is_executive' => 1
            ],
            'fayose@gmail.com' => [
                'password' => 'password',
                'phone' => '08012345677',
                'dob' => '1994-12-12',
                'is_executive' => 1
            ],
            'adams@gmail.com' => [
                'password' => 'password',
                'phone' => '080123456780',
                'dob' => '1994-12-12',
                'is_executive' => 1
            ],
            'saraki@gmail.com' => [
                'password' => 'password',
                'phone' => '080123456788',
                'dob' => '1994-12-12',
                'is_executive' => 1
            ],
            'femi@gmail.com' => [
                'password' => 'password',
                'phone' => '080123456738',
                'dob' => '1994-12-12',
                'is_executive' => 1
            ],
        ];

        
        foreach ($users as $email => $details) {
            DB::table('users')->insert([
                'dob' => $details['dob'],
                'tosAgreement' => '1',
                'phone' => $details['phone'],
                'email' => $email,
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt($details['password']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
