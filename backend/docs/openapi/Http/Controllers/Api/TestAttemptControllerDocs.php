<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class TestAttemptControllerDocs
{
    #[OA\Tag(name: 'Test Attempts', description: 'CRUD операции с попытками прохождения тестов')]

    #[OA\Get(
        path: '/test-attempts',
        summary: 'Получить список всех попыток',
        security: [['bearerAuth' => []]],
        tags: ['Test Attempts'],
        parameters: [
            new OA\Parameter(
                name: 'student_id',
                description: 'Фильтрация по ID студента',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'live_test_id',
                description: 'Фильтрация по ID теста',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список попыток')
        ]
    )]

    #[OA\Post(
        path: '/test-attempts',
        summary: 'Создать новую попытку',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['live_test_id', 'student_id'],
                properties: [
                    new OA\Property(property: 'live_test_id', type: 'integer', example: 11),
                    new OA\Property(property: 'student_id', type: 'integer', example: 42),
                    new OA\Property(property: 'started_at', type: 'string', format: 'date-time', example: '2025-04-16T09:00:00Z'),
                    new OA\Property(property: 'finished_at', type: 'string', format: 'date-time', example: '2025-04-16T09:25:00Z'),
                    new OA\Property(property: 'score', type: 'number', example: 87.5),
                ]
            )
        ),
        tags: ['Test Attempts'],
        responses: [
            new OA\Response(response: 201, description: 'Попытка создана')
        ]
    )]

    #[OA\Get(
        path: '/test-attempts/{id}',
        summary: 'Получить конкретную попытку',
        security: [['bearerAuth' => []]],
        tags: ['Test Attempts'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID попытки',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация о попытке'),
            new OA\Response(response: 404, description: 'Попытка не найдена')
        ]
    )]

    #[OA\Put(
        path: '/test-attempts/{id}',
        summary: 'Обновить попытку',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'started_at', type: 'string', format: 'date-time', example: '2025-04-16T09:05:00Z'),
                    new OA\Property(property: 'finished_at', type: 'string', format: 'date-time', example: '2025-04-16T09:35:00Z'),
                    new OA\Property(property: 'score', type: 'number', example: 90.0),
                ]
            )
        ),
        tags: ['Test Attempts'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID попытки',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Попытка обновлена'),
            new OA\Response(response: 404, description: 'Попытка не найдена')
        ]
    )]

    #[OA\Delete(
        path: '/test-attempts/{id}',
        summary: 'Удалить попытку',
        security: [['bearerAuth' => []]],
        tags: ['Test Attempts'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID попытки',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Попытка удалена'),
            new OA\Response(response: 404, description: 'Попытка не найдена')
        ]
    )]

    public function docs() {}
}
