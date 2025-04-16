<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class UniversityControllerDocs
{
    #[OA\Tag(name: 'Universities', description: 'CRUD операции с университетами')]

    #[OA\Get(
        path: '/universities',
        summary: 'Получить список университетов',
        security: [['bearerAuth' => []]],
        tags: ['Universities'],
        parameters: [
            new OA\Parameter(
                name: 'name',
                description: 'Фильтрация по названию университета',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список университетов')
        ]
    )]

    #[OA\Post(
        path: '/universities',
        summary: 'Создать новый университет',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Московский государственный университет'),
                ]
            )
        ),
        tags: ['Universities'],
        responses: [
            new OA\Response(response: 201, description: 'Университет создан')
        ]
    )]

    #[OA\Get(
        path: '/universities/{id}',
        summary: 'Получить конкретный университет',
        security: [['bearerAuth' => []]],
        tags: ['Universities'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID университета',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация об университете'),
            new OA\Response(response: 404, description: 'Университет не найден')
        ]
    )]

    #[OA\Put(
        path: '/universities/{id}',
        summary: 'Обновить университет',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'СПбГУ'),
                ]
            )
        ),
        tags: ['Universities'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID университета',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Университет обновлён'),
            new OA\Response(response: 404, description: 'Университет не найден')
        ]
    )]

    #[OA\Delete(
        path: '/universities/{id}',
        summary: 'Удалить университет',
        security: [['bearerAuth' => []]],
        tags: ['Universities'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID университета',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Университет удалён'),
            new OA\Response(response: 404, description: 'Университет не найден')
        ]
    )]

    public function docs() {}
}
