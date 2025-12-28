<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_sessions', function (Blueprint $table) {
            $table->increments('session_id');
            $table->unsignedInteger('student_id');
            $table->enum('status', ['online', 'offline', 'idle'])->default('offline');
            $table->timestamp('last_heartbeat')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('device_name', 100)->nullable();

            $table->foreign('student_id')->references('student_id')->on('students');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_sessions');
    }
};
