<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Запрос на создание, обновление и фильтрацию пользователей.
 */
class UserCRUDRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:6'],
            'role' => ['required', 'string', 'in:student,teacher,admin'],
        ];
    }

    public function filters(): array
    {
        return [
            'name' => $this->query('name'),
        ];
    }
}
