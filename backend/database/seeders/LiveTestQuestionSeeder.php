<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LiveTest;
use App\Models\Question;
use Illuminate\Database\Seeder;

class LiveTestQuestionSeeder extends Seeder
{
    public function run(): void
    {
        LiveTest::factory()
            ->count(5)
            ->create()
            ->each(function ($test) {
                $questions = Question::inRandomOrder()->limit(10)->get();
                $test->questions()->attach($questions->pluck('id'));
            });
    }
}
