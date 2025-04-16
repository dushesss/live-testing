<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Запрос на создание, обновление и фильтрацию вопросов.
 */
class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:1000'],
            'test_id' => ['required', 'integer', 'exists:live_tests,id'],
            'order' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function filters(): array
    {
        return [
            'search' => $this->query('search'),
        ];
    }
}
