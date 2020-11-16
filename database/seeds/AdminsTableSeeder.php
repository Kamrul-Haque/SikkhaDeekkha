<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new App\Admin;
        $admin->name = "Utchas";
        $admin->email = "utchas903@gmail.com";
        $admin->password = Hash::make("123456789");
        $admin->employee_id = 1000001;
        $admin->job_title = "Developer";
        $admin->phone = 1521479924;
        $admin->save();
    }
}
