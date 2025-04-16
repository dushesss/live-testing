<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * Сервис для управления пользователями.
 */
class UserService
{
    /**
     * Получить всех пользователей с фильтрацией по имени.
     *
     * @param string|null $name
     * @return Collection
     */
    public function all(?string $name = null): Collection
    {
        $query = User::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->get();
    }

    /**
     * Создать пользователя.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return User::create($data);
    }

    /**
     * Обновить пользователя.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }

    /**
     * Удалить пользователя.
     *
     * @param User $user
     */
    public function delete(User $user): void
    {
        $user->delete();
    }
}
