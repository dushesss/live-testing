<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('test_attempt_id')
                ->comment('ID попытки теста, к которой относится ответ')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('question_id')
                ->comment('Вопрос, на который студент ответил')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('answer_id')
                ->nullable()
                ->comment('Ответ, который выбрал студент (может быть null, если не ответил)')
                ->constrained()
                ->nullOnDelete();

            $table->timestamp('answered_at')
                ->nullable()
                ->comment('Момент времени, когда был отправлен ответ');

            $table->timestamps();

            $table->unique(['test_attempt_id', 'question_id'], 'unique_student_answer');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
