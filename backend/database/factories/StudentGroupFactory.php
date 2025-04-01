<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\StudentGroup;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentGroupFactory extends Factory
{
    protected $model = StudentGroup::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug,
            'name' => 'Группа ' . $this->faker->unique()->bothify('??-##'),
            'faculty_id' => Faculty::factory(),
        ];
    }
}
