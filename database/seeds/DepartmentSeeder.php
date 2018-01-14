<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Department::insert(['name' => 'Technical Support']);
        App\Department::insert(['name' => 'Sales']);
        App\Department::insert(['name' => 'Billing']);
    }
}
