<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name'      => 'Administrator',
            'email'     => 'admin@helpdesk.test',
            'password'  => bcrypt('password')
        ]);
    }
}
