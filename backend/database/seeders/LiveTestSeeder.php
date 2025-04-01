<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\LiveTest;
use Illuminate\Database\Seeder;

class LiveTestSeeder extends Seeder
{
    public function run(): void
    {
        User::where('role', 'teacher')->each(function ($teacher) {
            LiveTest::factory()->count(2)->create([
                'teacher_id' => $teacher->id,
            ]);
        });
    }
}
