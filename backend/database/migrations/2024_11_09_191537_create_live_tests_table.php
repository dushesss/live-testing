<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('live_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название теста');
            $table->string('slug')->comment('ЧПУ теста');
            $table->text('description')->comment('Описание теста');
            $table->boolean('active')->comment('Активность теста');
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_tests');
    }
};
