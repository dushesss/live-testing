<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCRUDRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления пользователями.
 */
class UserController extends Controller
{
    public function __construct(
        private readonly UserService $service
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Получить список пользователей (с фильтрацией по имени).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $users = $this->service->all($request->get('name'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $users);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать нового пользователя.
     *
     * @param UserCRUDRequest $request
     * @return JsonResponse
     */
    public function store(UserCRUDRequest $request): JsonResponse
    {
        try {
            $user = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $user);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Показать конкретного пользователя.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $user);
    }

    /**
     * Обновить данные пользователя.
     *
     * @param UserCRUDRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserCRUDRequest $request, User $user): JsonResponse
    {
        try {
            $updated = $this->service->update($user, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить пользователя.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $this->service->delete($user);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
