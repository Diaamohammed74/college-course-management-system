<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('image')->nullable()->default(null);
            $table->string('total_completed_hours')->nullable()->default(0);
            $table->string('total_enrolled_courses_marks')->nullable()->default(0);
            $table->string('total_courses_grades')->nullable()->default(0);
            $table->enum('status',['grad','undergrad'])->default('undergrad');
            $table->foreignId('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreignId('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
