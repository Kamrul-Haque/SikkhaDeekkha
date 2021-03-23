<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('discussion_panel_id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->string('subject');
            $table->text('body');
            $table->unsignedBigInteger('content_id')->nullable();
            $table->timestamps();

            $table->foreign('discussion_panel_id')->on('discussion_panels')->references('id')->onDelete('cascade');
            $table->foreign('content_id')->on('contents')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('threads');
    }
}
