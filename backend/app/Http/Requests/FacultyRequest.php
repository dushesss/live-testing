<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Класс запроса для создания/обновления факультета и фильтрации списка.
 */
class FacultyRequest extends FormRequest
{
    /**
     * Определяет, авторизован ли пользователь.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации для создания или обновления факультета.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'institute_id' => ['required', 'integer', 'exists:institutes,id'],
        ];
    }

    /**
     * Параметры фильтрации при получении списка факультетов.
     */
    public function filters(): array
    {
        return [
            'name' => $this->query('name'),
        ];
    }
}
