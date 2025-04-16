<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\LiveTest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Сервис управления живыми тестами.
 */
class LiveTestService
{
    /**
     * Получить все живые тесты с фильтрацией по названию.
     *
     * @param string|null $search
     * @return Collection
     */
    public function all(?string $search = null): Collection
    {
        $query = LiveTest::query();

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    /**
     * Найти живой тест по ID.
     *
     * @param int $id
     * @return LiveTest
     */
    public function find(int $id): LiveTest
    {
        $liveTest = LiveTest::find($id);

        if (!$liveTest) {
            throw new ModelNotFoundException('Тест не найден');
        }

        return $liveTest;
    }

    /**
     * Создать новый живой тест.
     *
     * @param array $data
     * @param int $userId
     * @return LiveTest
     */
    public function create(array $data, int $userId): LiveTest
    {
        $data['user_id'] = $userId;

        return LiveTest::create($data);
    }

    /**
     * Обновить живой тест.
     *
     * @param LiveTest $test
     * @param array $data
     * @return LiveTest
     */
    public function update(LiveTest $test, array $data): LiveTest
    {
        $test->update($data);
        return $test;
    }

    /**
     * Удалить живой тест.
     *
     * @param LiveTest $test
     */
    public function delete(LiveTest $test): void
    {
        $test->delete();
    }
}
