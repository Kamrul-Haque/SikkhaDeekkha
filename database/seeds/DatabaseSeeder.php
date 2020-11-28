<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(InstructorsTableSeeder::class);
    }
}
