<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->comment('ЧПУ факультета');
            $table->string('name')->comment('Название факультета');
            $table->unsignedBigInteger('institute_id')->comment('Внешний ключ института');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
