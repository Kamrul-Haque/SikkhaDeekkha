<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('UUID');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('designation');
            $table->string('department');
            $table->string('institution');
            $table->unsignedBigInteger('phone')->unique();
            $table->string('address')->nullable();
            $table->string('about');
            $table->boolean('is_verified')->default(false);
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructors');
    }
}
