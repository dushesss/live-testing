<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Запрос на создание, обновление и фильтрацию студенческих групп.
 */
class StudentGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'faculty_id' => ['required', 'integer', 'exists:faculties,id'],
        ];
    }

    public function filters(): array
    {
        return [
            'name' => $this->query('name'),
        ];
    }
}
