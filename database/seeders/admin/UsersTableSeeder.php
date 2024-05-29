<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['parent_id' => 1, 'access_key' => md5('tajamal@connect.com'), 'email' => 'tajamal@connect.com', 'password' => bcrypt('123456789'), 'readable_password' => '123456789']
        ]);
    }
}
