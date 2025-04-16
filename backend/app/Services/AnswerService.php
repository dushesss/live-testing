<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnswerService
{
    public function all(?string $search = null): Collection
    {
        $query = Answer::query();

        if ($search) {
            $query->where('text', 'like', "%$search%");
        }

        return $query->get();
    }

    public function create(array $data): Answer
    {
        return Answer::create($data);
    }

    public function find(int $id): Answer
    {
        $answer = Answer::find($id);

        if (!$answer) {
            throw new ModelNotFoundException('Ответ не найден');
        }

        return $answer;
    }

    public function update(Answer $answer, array $data): Answer
    {
        $answer->update($data);
        return $answer;
    }

    public function delete(Answer $answer): void
    {
        $answer->delete();
    }
}
