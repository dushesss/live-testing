<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class UserControllerDocs
{
    #[OA\Tag(name: 'Users', description: 'CRUD операции с пользователями')]

    #[OA\Get(
        path: '/users',
        summary: 'Получить список пользователей',
        security: [['bearerAuth' => []]],
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'name',
                description: 'Фильтрация по имени',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список пользователей')
        ]
    )]

    #[OA\Post(
        path: '/users',
        summary: 'Создать нового пользователя',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email', 'password', 'role'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Иван Иванов'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'ivan@example.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'securePassword123'),
                    new OA\Property(property: 'role', type: 'string', enum: ['admin', 'teacher', 'student'], example: 'student'),
                ]
            )
        ),
        tags: ['Users'],
        responses: [
            new OA\Response(response: 201, description: 'Пользователь создан')
        ]
    )]

    #[OA\Get(
        path: '/users/{id}',
        summary: 'Получить конкретного пользователя',
        security: [['bearerAuth' => []]],
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID пользователя',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация о пользователе'),
            new OA\Response(response: 404, description: 'Пользователь не найден')
        ]
    )]

    #[OA\Put(
        path: '/users/{id}',
        summary: 'Обновить пользователя',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Пётр Петров'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'petr@example.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'newSecurePassword'),
                    new OA\Property(property: 'role', type: 'string', enum: ['admin', 'teacher', 'student'], example: 'teacher'),
                ]
            )
        ),
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID пользователя',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Пользователь обновлён'),
            new OA\Response(response: 404, description: 'Пользователь не найден')
        ]
    )]

    #[OA\Delete(
        path: '/users/{id}',
        summary: 'Удалить пользователя',
        security: [['bearerAuth' => []]],
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID пользователя',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Пользователь удалён'),
            new OA\Response(response: 404, description: 'Пользователь не найден')
        ]
    )]

    public function docs() {}
}
