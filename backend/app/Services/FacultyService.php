<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Сервис управления факультетами.
 */
class FacultyService
{
    /**
     * Получить список всех факультетов с фильтрацией по названию.
     *
     * @param string|null $name
     * @return Collection
     */
    public function all(?string $name = null): Collection
    {
        $query = Faculty::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->get();
    }

    /**
     * Найти факультет по ID.
     *
     * @param int $id
     * @return Faculty
     *
     * @throws ModelNotFoundException
     */
    public function find(int $id): Faculty
    {
        $faculty = Faculty::find($id);

        if (!$faculty) {
            throw new ModelNotFoundException('Факультет не найден');
        }

        return $faculty;
    }

    /**
     * Создать новый факультет.
     *
     * @param array $data
     * @return Faculty
     */
    public function create(array $data): Faculty
    {
        return Faculty::create($data);
    }

    /**
     * Обновить факультет.
     *
     * @param Faculty $faculty
     * @param array $data
     * @return Faculty
     */
    public function update(Faculty $faculty, array $data): Faculty
    {
        $faculty->update($data);
        return $faculty;
    }

    /**
     * Удалить факультет.
     *
     * @param Faculty $faculty
     */
    public function delete(Faculty $faculty): void
    {
        $faculty->delete();
    }
}
