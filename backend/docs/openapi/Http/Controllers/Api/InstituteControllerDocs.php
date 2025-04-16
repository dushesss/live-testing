<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class InstituteControllerDocs
{
    #[OA\Tag(name: 'Institutes', description: 'CRUD операции с институтами')]

    #[OA\Get(
        path: '/institutes',
        summary: 'Получить список всех институтов',
        security: [['bearerAuth' => []]],
        tags: ['Institutes'],
        parameters: [
            new OA\Parameter(
                name: 'name',
                description: 'Фильтрация по названию',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список институтов')
        ]
    )]

    #[OA\Post(
        path: '/institutes',
        summary: 'Создать новый институт',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'university_id'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Институт робототехники'),
                    new OA\Property(property: 'university_id', type: 'integer', example: 3),
                ]
            )
        ),
        tags: ['Institutes'],
        responses: [
            new OA\Response(response: 201, description: 'Институт создан')
        ]
    )]

    #[OA\Get(
        path: '/institutes/{id}',
        summary: 'Получить конкретный институт',
        security: [['bearerAuth' => []]],
        tags: ['Institutes'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID института',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация об институте'),
            new OA\Response(response: 404, description: 'Институт не найден')
        ]
    )]

    #[OA\Put(
        path: '/institutes/{id}',
        summary: 'Обновить институт',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Институт ИИ и данных'),
                    new OA\Property(property: 'university_id', type: 'integer', example: 3),
                ]
            )
        ),
        tags: ['Institutes'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID института',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Институт обновлён'),
            new OA\Response(response: 404, description: 'Институт не найден')
        ]
    )]

    #[OA\Delete(
        path: '/institutes/{id}',
        summary: 'Удалить институт',
        security: [['bearerAuth' => []]],
        tags: ['Institutes'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID института',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Институт удалён'),
            new OA\Response(response: 404, description: 'Институт не найден')
        ]
    )]

    public function docs() {}
}
