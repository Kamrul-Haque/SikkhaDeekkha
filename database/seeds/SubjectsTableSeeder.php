<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = new \App\Subject();
        $subject->subject_name = "Physics";
        $subject->save();

        $subject = new \App\Subject();
        $subject->subject_name = "Chemistry";
        $subject->save();

        $subject = new \App\Subject();
        $subject->subject_name = "Biology";
        $subject->save();

        $subject = new \App\Subject();
        $subject->subject_name = "Computer Science";
        $subject->save();
    }
}
