<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = new \App\Student;
        $student->name = "Masud Rana";
        $student->email = "masud@gmail.com";
        $student->password =\Illuminate\Support\Facades\Hash::make("12345678");
        $student->study_level = "Undergraduate";
        $student->institution = "DIU";
        $student->specialization = "B.Sc. in SWE";
        $student->interests = "Web Development";
        $student->save();
    }
}
