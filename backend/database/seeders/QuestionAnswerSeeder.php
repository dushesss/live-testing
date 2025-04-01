<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class QuestionAnswerSeeder extends Seeder
{
    public function run(): void
    {
        Question::factory()
            ->count(10)
            ->create()
            ->each(function ($question) {
                $answers = Answer::factory()->count(4)->create();

                foreach ($answers as $index => $answer) {
                    $question->answers()->attach($answer->id, [
                        'is_correct' => $index === 0,
                    ]);
                }
            });
    }
}
