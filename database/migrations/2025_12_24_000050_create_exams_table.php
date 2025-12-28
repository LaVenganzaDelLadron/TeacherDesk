<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('exam_id');
            $table->string('room', 255);
            $table->string('title', 255);
            $table->integer('duration');
            $table->date('exam_date')->nullable();
            $table->text('requirement')->nullable();
            $table->unsignedInteger('target_course');
            $table->integer('target_yearLevel');
            $table->unsignedInteger('created_by');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('target_course')->references('course_id')->on('courses');
            $table->foreign('created_by')->references('admin_id')->on('admins');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
