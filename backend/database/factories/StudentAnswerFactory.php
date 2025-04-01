<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\StudentAnswer;
use App\Models\TestAttempt;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentAnswerFactory extends Factory
{
    protected $model = StudentAnswer::class;

    public function definition(): array
    {
        return [
            'test_attempt_id' => TestAttempt::factory(),
            'question_id'     => Question::factory(),
            'answer_id'       => rand(0, 1) ? Answer::factory() : null,
            'answered_at'     => $this->faker->dateTimeBetween('-10 minutes', 'now'),
        ];
    }
}
