<?php

namespace Database\Seeders;

use App\Models\StudentGroup;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class StudentGroupSeeder extends Seeder
{
    public function run(): void
    {
        Faculty::all()->each(function ($faculty) {
            StudentGroup::factory()->count(2)->create([
                'faculty_id' => $faculty->id,
            ]);
        });
    }
}
