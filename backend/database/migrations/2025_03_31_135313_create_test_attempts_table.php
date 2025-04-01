<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('live_test_id')
                ->comment('ID теста, который проходится студентом')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('student_name')
                ->comment('Имя студента, введённое перед началом теста');

            $table->foreignId('student_group_id')
                ->nullable()
                ->comment('Группа студента, если указана')
                ->constrained()
                ->nullOnDelete();

            $table->timestamp('started_at')
                ->nullable()
                ->comment('Когда студент начал попытку');

            $table->timestamp('finished_at')
                ->nullable()
                ->comment('Когда студент закончил попытку');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
