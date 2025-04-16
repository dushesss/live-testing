<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Запрос на создание, обновление и фильтрацию ответов студентов.
 */
class StudentAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question_id' => ['required', 'integer', 'exists:questions,id'],
            'answer_id' => ['required', 'integer', 'exists:answers,id'],
            'test_attempt_id' => ['required', 'integer', 'exists:test_attempts,id'],
        ];
    }

    public function filters(): array
    {
        return [
            'question_id' => $this->query('question_id'),
        ];
    }
}
