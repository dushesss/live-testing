<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Institute;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InstituteFactory extends Factory
{
    protected $model = Institute::class;

    public function definition(): array
    {
        $name = 'Институт ' . $this->faker->unique()->word();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'university_id' => University::factory(),
        ];
    }
}
