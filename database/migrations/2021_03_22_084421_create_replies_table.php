<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->text('message');
            $table->timestamps();

            $table->foreign('student_id')->on('students')->references('id')->onDelete('cascade');
            $table->foreign('instructor_id')->on('instructors')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
