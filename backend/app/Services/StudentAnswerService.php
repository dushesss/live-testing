<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\StudentAnswer;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для управления ответами студентов.
 */
class StudentAnswerService
{
    /**
     * Получить все ответы студентов, с фильтрацией по question_id.
     *
     * @param int|null $questionId
     * @return Collection
     */
    public function all(?int $questionId = null): Collection
    {
        $query = StudentAnswer::query();

        if ($questionId) {
            $query->where('question_id', $questionId);
        }

        return $query->get();
    }

    /**
     * Создать новый ответ студента.
     *
     * @param array $data
     * @return StudentAnswer
     */
    public function create(array $data): StudentAnswer
    {
        return StudentAnswer::create($data);
    }

    /**
     * Обновить ответ студента.
     *
     * @param StudentAnswer $studentAnswer
     * @param array $data
     * @return StudentAnswer
     */
    public function update(StudentAnswer $studentAnswer, array $data): StudentAnswer
    {
        $studentAnswer->update($data);
        return $studentAnswer;
    }

    /**
     * Удалить ответ студента.
     *
     * @param StudentAnswer $studentAnswer
     */
    public function delete(StudentAnswer $studentAnswer): void
    {
        $studentAnswer->delete();
    }
}
