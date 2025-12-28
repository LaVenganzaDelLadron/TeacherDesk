<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->increments('command_id');
            $table->unsignedInteger('student_id');
            $table->text('command');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('executed_at')->nullable();

            $table->foreign('student_id')->references('student_id')->on('students');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commands');
    }
};
