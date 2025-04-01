<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('Внешний ключ пользователя')->constrained()->cascadeOnDelete();
            $table->string('first_name')->comment('Имя преподавателя');
            $table->string('last_name')->comment('Фамилия преподавателя')->nullable();
            $table->string('middle_name')->comment('Отчество преподавателя')->nullable();
            $table->foreignId('university_id')->comment('Внешний ключ университета')->nullable()->constrained()->cascadeOnDelete();
            $table->string('full_name')->comment('Полное имя');
            $table->string('email')->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
