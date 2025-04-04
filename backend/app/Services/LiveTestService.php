<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\LiveTest;
use Illuminate\Support\Collection;

class LiveTestService
{
    public function all(): Collection
    {
        return LiveTest::all();
    }

    public function create(array $data, int $teacherId): LiveTest
    {
        $data['teacher_id'] = $teacherId;
        return LiveTest::create($data);
    }

    public function update(LiveTest $test, array $data): LiveTest
    {
        $test->update($data);
        return $test;
    }

    public function delete(LiveTest $test): void
    {
        $test->delete();
    }
}
