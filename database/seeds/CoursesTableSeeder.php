<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course = new \App\Course;
        $course->title = "Space Wrap with Unity";
        $course->subtitle = "Learn to make exciting games in most popular game engine Unity without any prior knowledge on game development.";
        $course->level = "Undergraduate";
        $course->difficulty = "Beginner";
        $course->duration = "3 Weeks";
        $course->subject_id = 4;
        $course->topic = "Game Development";
        $course->description = "<p>This course is intended for beginners interested in game development with no prior knowledge.
                                Through the course student will learn about basics of not only Unity programming but also other components of Unity.
                                Prior knowledge of object oriented programming will be helpful but not required.
                                At the end of the course, a real fully functional 2D game will be built.
                                Although this course will not cover building graphics assets for the game.</p>";
        $course->syllabus = "<ul>
                                <li>Introduction</li>
                                <li>Unity Setup with Visual Studio as default code editor</li>
                                <li>Scenes, Assets, Scripts, Sprites, Prefabs</li>
                                <li>Basic Script</li>
                                <li>Rigid Bodies &amp; Colliders</li>
                                <li>Timers, Awake &amp; Start</li>
                                <li>Update &amp; Fixed Update</li>
                                <li>Classes &amp; Objects</li>
                                <li>Spawning &amp; Destroying</li>
                                <li>Forces, Angles and Direction</li>
                                <li>Building the Game</li>
                            </ul>";
        $course->prerequisites = "<p>Knowledge of:&nbsp;</p>

                                    <ol>
                                        <li>Basic Maths</li>
                                        <li>Basic Physics</li>
                                        <li>Basic Programming</li>
                                        <li>Object Oriented Programming Concept</li>
                                    </ol>";
        $course->expected_outcome = "<p>Learn to make 2D games with Unity developing a real indie game.</p>";
        $course->date_starting = "2020-12-01";
        $course->has_certificate = true;
        $course->completion_marks = 70;
        $course->save();
    }
}
