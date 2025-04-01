<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\University;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    public function run(): void
    {
        University::all()->each(function ($university) {
            Institute::factory()->count(2)->create([
                'university_id' => $university->id,
            ]);
        });
    }
}
