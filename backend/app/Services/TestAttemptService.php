<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\TestAttempt;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для управления попытками прохождения тестов.
 */
class TestAttemptService
{
    /**
     * Получить все попытки, с фильтрацией по студенту и/или тесту.
     *
     * @param int|null $studentId
     * @param int|null $liveTestId
     * @return Collection
     */
    public function all(?int $studentId = null, ?int $liveTestId = null): Collection
    {
        $query = TestAttempt::query();

        if ($studentId) {
            $query->where('student_id', $studentId);
        }

        if ($liveTestId) {
            $query->where('live_test_id', $liveTestId);
        }

        return $query->get();
    }

    /**
     * Создать новую попытку.
     *
     * @param array $data
     * @return TestAttempt
     */
    public function create(array $data): TestAttempt
    {
        return TestAttempt::create($data);
    }

    /**
     * Обновить существующую попытку.
     *
     * @param TestAttempt $attempt
     * @param array $data
     * @return TestAttempt
     */
    public function update(TestAttempt $attempt, array $data): TestAttempt
    {
        $attempt->update($data);
        return $attempt;
    }

    /**
     * Удалить попытку.
     *
     * @param TestAttempt $attempt
     */
    public function delete(TestAttempt $attempt): void
    {
        $attempt->delete();
    }
}
