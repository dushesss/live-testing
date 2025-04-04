<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class LiveTestControllerDocs
{
    #[OA\Tag(name: 'Live Tests', description: 'CRUD операции с тестами')]
    #[OA\Get(
        path: '/live-tests',
        summary: 'Получить список всех тестов',
        security: [['bearerAuth' => []]],
        tags: ['Live Tests'],
        responses: [
            new OA\Response(response: 200, description: 'Список тестов')
        ]
    )]

    #[OA\Post(
        path: '/live-tests',
        summary: 'Создать новый тест',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'slug', 'active'],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'slug', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'active', type: 'boolean'),
                    new OA\Property(property: 'is_published', type: 'boolean'),
                ]
            )
        ),
        tags: ['Live Tests'],
        responses: [
            new OA\Response(response: 201, description: 'Тест успешно создан')
        ]
    )]

    #[OA\Get(
        path: '/live-tests/{id}',
        summary: 'Получить конкретный тест',
        security: [['bearerAuth' => []]],
        tags: ['Live Tests'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация о тесте'),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
            new OA\Response(response: 404, description: 'Тест не найден')
        ]
    )]

    #[OA\Put(
        path: '/live-tests/{id}',
        summary: 'Обновить тест',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'slug', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'active', type: 'boolean'),
                    new OA\Property(property: 'is_published', type: 'boolean'),
                ]
            )
        ),
        tags: ['Live Tests'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Тест обновлён'),
            new OA\Response(response: 403, description: 'Доступ запрещён')
        ]
    )]

    #[OA\Delete(
        path: '/live-tests/{id}',
        summary: 'Удалить тест',
        security: [['bearerAuth' => []]],
        tags: ['Live Tests'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Тест удалён'),
            new OA\Response(response: 403, description: 'Доступ запрещён')
        ]
    )]

    public function docs() {}
}
