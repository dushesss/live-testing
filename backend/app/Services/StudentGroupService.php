<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\StudentGroup;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для управления студенческими группами.
 */
class StudentGroupService
{
    /**
     * Получить список всех групп с фильтрацией по названию.
     *
     * @param string|null $name
     * @return Collection
     */
    public function all(?string $name = null): Collection
    {
        $query = StudentGroup::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->get();
    }

    /**
     * Создать новую группу.
     *
     * @param array $data
     * @return StudentGroup
     */
    public function create(array $data): StudentGroup
    {
        return StudentGroup::create($data);
    }

    /**
     * Обновить группу.
     *
     * @param StudentGroup $group
     * @param array $data
     * @return StudentGroup
     */
    public function update(StudentGroup $group, array $data): StudentGroup
    {
        $group->update($data);
        return $group;
    }

    /**
     * Удалить группу.
     *
     * @param StudentGroup $group
     */
    public function delete(StudentGroup $group): void
    {
        $group->delete();
    }
}
