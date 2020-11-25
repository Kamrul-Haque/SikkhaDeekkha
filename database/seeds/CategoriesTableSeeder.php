<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category;
        $category->category_name = "Physics";
        $category->save();

        $category = new Category;
        $category->category_name = "Chemistry";
        $category->save();

        $category = new Category;
        $category->category_name = "Biology";
        $category->save();

        $category = new Category;
        $category->category_name = "Computer Science";
        $category->save();
    }
}
