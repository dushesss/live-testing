<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_groups', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->comment('ЧПУ группы студентов');
            $table->string('name')->comment('Название группы студентов');
            $table->unsignedBigInteger('faculty_id')->comment('Внешний ключ факультета');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_groups');
    }
};
