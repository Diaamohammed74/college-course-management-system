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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('status',['active','disable'])->default('active');
            $table->enum('designation',['doctor','assistant'])->default('doctor');
            $table->foreignId('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->default(null)->references('id')->on('courses')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
