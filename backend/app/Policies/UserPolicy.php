<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Политика доступа к модели User.
 * Пользователь может видеть, изменять и удалять только самого себя.
 */
class UserPolicy
{
    /**
     * Просмотр списка пользователей — доступ разрешён  для отображения списка в UI.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Просмотр конкретного пользователя — только самого себя.
     */
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Создание новых пользователей — по умолчанию разрешено при регистрации.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Обновление пользователя — только самого себя.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Удаление пользователя — только самого себя.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Восстановление — не используется.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Удаление навсегда — не используется.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
