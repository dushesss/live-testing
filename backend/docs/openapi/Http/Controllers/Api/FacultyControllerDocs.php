<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class FacultyControllerDocs
{
    #[OA\Tag(name: 'Faculties', description: 'CRUD операции с факультетами')]

    #[OA\Get(
        path: '/faculties',
        summary: 'Получить список всех факультетов',
        security: [['bearerAuth' => []]],
        tags: ['Faculties'],
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
            new OA\Response(response: 200, description: 'Список факультетов')
        ]
    )]

    #[OA\Post(
        path: '/faculties',
        summary: 'Создать новый факультет',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'institute_id'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Факультет прикладной математики'),
                    new OA\Property(property: 'institute_id', type: 'integer', example: 5),
                ]
            )
        ),
        tags: ['Faculties'],
        responses: [
            new OA\Response(response: 201, description: 'Факультет создан')
        ]
    )]

    #[OA\Get(
        path: '/faculties/{id}',
        summary: 'Получить конкретный факультет',
        security: [['bearerAuth' => []]],
        tags: ['Faculties'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID факультета',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация о факультете'),
            new OA\Response(response: 404, description: 'Факультет не найден')
        ]
    )]

    #[OA\Put(
        path: '/faculties/{id}',
        summary: 'Обновить факультет',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Факультет компьютерных наук'),
                    new OA\Property(property: 'institute_id', type: 'integer', example: 2),
                ]
            )
        ),
        tags: ['Faculties'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID факультета',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Факультет обновлён'),
            new OA\Response(response: 404, description: 'Факультет не найден')
        ]
    )]

    #[OA\Delete(
        path: '/faculties/{id}',
        summary: 'Удалить факультет',
        security: [['bearerAuth' => []]],
        tags: ['Faculties'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID факультета',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Факультет удалён'),
            new OA\Response(response: 404, description: 'Факультет не найден')
        ]
    )]

    public function docs() {}
}
