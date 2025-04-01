<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Запуск всех сидеров базы данных.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            UniversitySeeder::class,
            InstituteSeeder::class,
            FacultySeeder::class,
            StudentGroupSeeder::class,
            LiveTestSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            QuestionAnswerSeeder::class,
            LiveTestQuestionSeeder::class,
            TestAttemptSeeder::class,
            StudentAnswerSeeder::class,
        ]);
    }
}
