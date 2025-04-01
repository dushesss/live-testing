<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UniversityFactory extends Factory
{
    protected $model = University::class;

    public function definition(): array
    {
        $name = $this->faker->company . ' University';

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
