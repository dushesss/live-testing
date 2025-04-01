<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Регистрация нового пользователя.
     *
     * @param AuthRequest $request Запрос с данными пользователя (валидирован заранее)
     * @param AuthService $authService Сервис авторизации, выполняющий бизнес-логику
     * @return JsonResponse Ответ с зарегистрированным пользователем
     */
    public function register(AuthRequest $request, AuthService $authService): JsonResponse
    {
        $user = $authService->register($request->validated());

        return $this->apiResponse(201, 'success', ['user' => $user]);
    }

    /**
     * Авторизация пользователя и выдача токена.
     *
     * @param AuthRequest $request Запрос с логином и паролем
     * @param AuthService $authService Сервис авторизации
     * @return JsonResponse Ответ с токеном или ошибкой
     */
    public function login(AuthRequest $request, AuthService $authService): JsonResponse
    {
        $credentials = $request->only('login', 'password');

        $tokenData = $authService->login($credentials);

        if (!$tokenData) {
            return $this->apiResponse(422, 'error', 'Неверный логин или пароль');
        }

        return $this->apiResponse(200, 'success', $tokenData);
    }

    /**
     * Получение данных текущего авторизованного пользователя.
     *
     * @param Request $request HTTP-запрос с авторизацией
     * @return JsonResponse Ответ с данными пользователя
     */
    public function user(Request $request): JsonResponse
    {
        return $this->apiResponse(200, 'success', $request->user());
    }

    /**
     * Выход пользователя и удаление текущего токена.
     *
     * @param Request $request HTTP-запрос от авторизованного пользователя
     * @return JsonResponse Ответ об успешном выходе
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return $this->apiResponse(200, 'success', 'Выход выполнен успешно');
    }
}
