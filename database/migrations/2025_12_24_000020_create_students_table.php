<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->increments('student_id');
                $table->string('username', 50);
                $table->string('email', 100)->unique();
                $table->string('password', 255);
                $table->unsignedInteger('course_id');
                $table->integer('yearLevel');
                $table->enum('status', ['active', 'inactive'])->default('inactive');
                $table->unsignedBigInteger('created_by');
                $table->timestamp('created_at')->useCurrent();

                $table->foreign('course_id')->references('course_id')->on('courses');
                $table->foreign('created_by')->references('id')->on('users');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
