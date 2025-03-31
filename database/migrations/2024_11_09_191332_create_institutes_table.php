<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->comment('ЧПУ института');
            $table->string('name')->comment('Название института');
            $table->unsignedBigInteger('university_id')->comment('Внешний ключ университета');
            $table->foreignId('university_id')->references('id')->on('universities')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
