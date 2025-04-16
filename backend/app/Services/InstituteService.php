<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Institute;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для управления институтами.
 */
class InstituteService
{
    /**
     * Получить все институты, с фильтрацией по названию.
     *
     * @param string|null $name
     * @return Collection
     */
    public function all(?string $name = null): Collection
    {
        $query = Institute::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->get();
    }

    /**
     * Создать новый институт.
     *
     * @param array $data
     * @return Institute
     */
    public function create(array $data): Institute
    {
        return Institute::create($data);
    }

    /**
     * Обновить существующий институт.
     *
     * @param Institute $institute
     * @param array $data
     * @return Institute
     */
    public function update(Institute $institute, array $data): Institute
    {
        $institute->update($data);
        return $institute;
    }

    /**
     * Удалить институт.
     *
     * @param Institute $institute
     */
    public function delete(Institute $institute): void
    {
        $institute->delete();
    }
}
