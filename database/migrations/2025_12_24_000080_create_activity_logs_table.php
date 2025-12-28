<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->increments('log_id');
            $table->unsignedInteger('student_id');
            $table->enum('activity_type', [
                'login',
                'logout',
                'tab_switch',
                'idle',
                'command',
                'exam_start',
                'exam_end',
                'violation',
            ]);
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('student_id')->references('student_id')->on('students');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
