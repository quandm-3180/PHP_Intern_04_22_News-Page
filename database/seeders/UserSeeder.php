<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->insert([
            'name' => 'AdminQuan',
            'email' => 'do.minh.quan@sun-asterisk.com',
            'password' => Hash::make('123123123'),
            'phone' => '0123456789',
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'role_id' => config('custom.user_roles.admin'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        Model::reguard();
    }
}
