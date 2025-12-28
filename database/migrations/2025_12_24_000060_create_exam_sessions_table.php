<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->increments('session_id');
            $table->unsignedInteger('exam_id');
            $table->enum('status', ['pending', 'active', 'ended'])->default('pending');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            $table->foreign('exam_id')->references('exam_id')->on('exams');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};
