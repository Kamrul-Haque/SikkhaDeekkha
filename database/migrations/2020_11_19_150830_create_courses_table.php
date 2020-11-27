<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('subtitle');
            $table->string('level');
            $table->string('difficulty');
            $table->string('duration');
            $table->unsignedBigInteger('subject_id');
            $table->string('topic');
            $table->text('description');
            $table->text('syllabus');
            $table->text('prerequisites');
            $table->text('expected_outcome');
            $table->string('image_path')->nullable();
            $table->string('date_starting');
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->boolean('has_certificate')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->integer('completion_marks')->unsigned()->nullable();
            $table->decimal('fee',7,2)->unsigned()->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('institutions');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
