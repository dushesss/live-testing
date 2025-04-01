<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Faculty;
use App\Models\Institute;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    protected $model = Faculty::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug,
            'name' => $this->faker->company . ' Faculty',
            'institute_id' => Institute::factory(),
        ];
    }
}
