<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Institute;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        Institute::all()->each(function ($institute) {
            Faculty::factory()->count(2)->create([
                'institute_id' => $institute->id,
            ]);
        });
    }
}
