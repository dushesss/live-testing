<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('live_tests_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('live_test_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['live_test_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_tests_questions');
    }
};
