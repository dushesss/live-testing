<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\TestAttempt;
use App\Models\LiveTest;
use App\Models\StudentGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestAttemptFactory extends Factory
{
    protected $model = TestAttempt::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 day', 'now');
        $end = (clone $start)->modify('+30 minutes');

        return [
            'live_test_id'     => LiveTest::factory(),
            'student_name'     => $this->faker->name,
            'student_group_id' => rand(0, 1) ? StudentGroup::factory() : null,
            'started_at'       => $start,
            'finished_at'      => $end,
        ];
    }
}
