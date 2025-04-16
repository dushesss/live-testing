<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Запрос на создание, обновление и фильтрацию попыток прохождения теста.
 */
class TestAttemptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'live_test_id' => ['required', 'integer', 'exists:live_tests,id'],
            'student_id' => ['required', 'integer', 'exists:users,id'],
            'started_at' => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date'],
            'score' => ['nullable', 'numeric'],
        ];
    }

    public function filters(): array
    {
        return [
            'student_id' => $this->query('student_id'),
            'live_test_id' => $this->query('live_test_id'),
        ];
    }
}
