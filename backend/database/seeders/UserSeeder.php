<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Админ',
            'login' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'super_admin',
        ]);

        User::factory()->count(5)->create([
            'role' => 'teacher',
        ]);
    }
}
