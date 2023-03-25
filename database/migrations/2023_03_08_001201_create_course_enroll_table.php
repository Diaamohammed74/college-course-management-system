<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('course_enroll', function (Blueprint $table) {
            $table->foreignId('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('course_grade')->default(0);
            $table->primary(['student_id', 'course_id']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('course_enroll');
    }
};
