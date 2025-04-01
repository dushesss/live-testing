<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class AuthControllerDocs
{
    #[OA\Post(
        path: '/register',
        summary: 'Регистрация нового пользователя',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'login', 'email', 'password'],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'login', type: 'string'),
                    new OA\Property(property: 'email', type: 'string'),
                    new OA\Property(property: 'password', type: 'string'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Пользователь зарегистрирован'),
        ]
    )]

    #[OA\Post(
        path: '/login',
        summary: 'Авторизация пользователя и получение токена',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['login', 'password'],
                properties: [
                    new OA\Property(property: 'login', type: 'string'),
                    new OA\Property(property: 'password', type: 'string'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Успешная авторизация и выдача токена'),
            new OA\Response(response: 422, description: 'Неверный логин или пароль'),
        ]
    )]

    #[OA\Get(
        path: '/user',
        summary: 'Получение текущего пользователя',
        security: [ ['bearerAuth' => []] ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешно',
            )
        ]
    )]

    #[OA\Post(
        path: '/logout',
        summary: 'Выход пользователя и удаление токена',
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Успешный выход'),
        ]
    )]
    public function docs() {}
}
