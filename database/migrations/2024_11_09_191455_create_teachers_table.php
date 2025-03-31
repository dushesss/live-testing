<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('Имя преподавателя');
            $table->string('last_name')->comment('Фамилия преподавателя')->nullable();
            $table->string('middle_name')->comment('Отчество преподавателя')->nullable();
            $table->unsignedBigInteger('faculty_id')->comment('Внешний ключ факультета')->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('set null');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
