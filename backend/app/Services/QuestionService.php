<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для управления вопросами.
 */
class QuestionService
{
    /**
     * Получить все вопросы, с фильтрацией по тексту.
     *
     * @param string|null $search
     * @return Collection
     */
    public function all(?string $search = null): Collection
    {
        $query = Question::query();

        if ($search) {
            $query->where('text', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    /**
     * Создать новый вопрос.
     *
     * @param array $data
     * @return Question
     */
    public function create(array $data): Question
    {
        return Question::create($data);
    }

    /**
     * Обновить вопрос.
     *
     * @param Question $question
     * @param array $data
     * @return Question
     */
    public function update(Question $question, array $data): Question
    {
        $question->update($data);
        return $question;
    }

    /**
     * Удалить вопрос.
     *
     * @param Question $question
     */
    public function delete(Question $question): void
    {
        $question->delete();
    }
}
