<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\LiveTest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LiveTestFactory extends Factory
{
    protected $model = LiveTest::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'active' => $this->faker->boolean,
            'teacher_id' => User::factory(),
            'is_published' => $this->faker->boolean(30),
        ];
    }
}
