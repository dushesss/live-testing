<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер авторизации пользователей.
 */
class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $service
    ) {}

    /**
     * Регистрация нового пользователя.
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function register(AuthRequest $request): JsonResponse
    {
        try {
            $user = $this->service->register($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', ['user' => $user]);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Авторизация пользователя и выдача токена.
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('login', 'password');

            $tokenData = $this->service->login($credentials);

            if (!$tokenData) {
                return $this->apiResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'error', 'Неверный логин или пароль');
            }

            return $this->apiResponse(Response::HTTP_OK, 'success', $tokenData);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получение данных текущего авторизованного пользователя.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $request->user());
    }

    /**
     * Выход пользователя и удаление текущего токена.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return $this->apiResponse(Response::HTTP_OK, 'success', 'Выход выполнен успешно');
    }
}
