<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiveTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:live_tests,slug,' . $this->route('live_test')?->id],
            'description' => ['nullable', 'string'],
            'active' => ['required', 'boolean'],
            'is_published' => ['boolean'],
        ];
    }
}
