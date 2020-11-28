<?php

use Illuminate\Database\Seeder;

class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instructor = new \App\Instructor;
        $instructor->UUID = \Illuminate\Support\Str::uuid()->toString();
        $instructor->name = "Md. Kamrul Haque";
        $instructor->email = "utchas4@yahoo.com";
        $instructor->password = \Illuminate\Support\Facades\Hash::make("123456789");
        $instructor->phone = "1521479924";
        $instructor->designation = "Lecturer";
        $instructor->department = "SWE";
        $instructor->institution = "DIU";
        $instructor->about = "7 years of experience in Game Development";
        $instructor->save();
    }
}
