<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\University;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для управления университетами.
 */
class UniversityService
{
    /**
     * Получить все университеты с фильтрацией по названию.
     *
     * @param string|null $name
     * @return Collection
     */
    public function all(?string $name = null): Collection
    {
        $query = University::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->get();
    }

    /**
     * Создать университет.
     *
     * @param array $data
     * @return University
     */
    public function create(array $data): University
    {
        return University::create($data);
    }

    /**
     * Обновить университет.
     *
     * @param University $university
     * @param array $data
     * @return University
     */
    public function update(University $university, array $data): University
    {
        $university->update($data);
        return $university;
    }

    /**
     * Удалить университет.
     *
     * @param University $university
     */
    public function delete(University $university): void
    {
        $university->delete();
    }
}
