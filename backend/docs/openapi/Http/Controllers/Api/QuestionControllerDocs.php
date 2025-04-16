<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class QuestionControllerDocs
{
    #[OA\Tag(name: 'Questions', description: 'CRUD операции с вопросами')]

    #[OA\Get(
        path: '/questions',
        summary: 'Получить список всех вопросов',
        security: [['bearerAuth' => []]],
        tags: ['Questions'],
        parameters: [
            new OA\Parameter(
                name: 'text',
                description: 'Фильтрация по тексту вопроса',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список вопросов')
        ]
    )]

    #[OA\Post(
        path: '/questions',
        summary: 'Создать новый вопрос',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['text', 'live_test_id'],
                properties: [
                    new OA\Property(property: 'text', type: 'string', example: 'Какой город является столицей Франции?'),
                    new OA\Property(property: 'live_test_id', type: 'integer', example: 12),
                    new OA\Property(property: 'order', type: 'integer', example: 1),
                    new OA\Property(property: 'type', type: 'string', example: 'single'),
                ]
            )
        ),
        tags: ['Questions'],
        responses: [
            new OA\Response(response: 201, description: 'Вопрос успешно создан')
        ]
    )]

    #[OA\Get(
        path: '/questions/{id}',
        summary: 'Получить конкретный вопрос',
        security: [['bearerAuth' => []]],
        tags: ['Questions'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID вопроса',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация о вопросе'),
            new OA\Response(response: 404, description: 'Вопрос не найден')
        ]
    )]

    #[OA\Put(
        path: '/questions/{id}',
        summary: 'Обновить вопрос',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'text', type: 'string', example: 'Какой город является столицей Италии?'),
                    new OA\Property(property: 'order', type: 'integer', example: 2),
                    new OA\Property(property: 'type', type: 'string', example: 'multiple'),
                ]
            )
        ),
        tags: ['Questions'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID вопроса',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Вопрос обновлён'),
            new OA\Response(response: 404, description: 'Вопрос не найден')
        ]
    )]

    #[OA\Delete(
        path: '/questions/{id}',
        summary: 'Удалить вопрос',
        security: [['bearerAuth' => []]],
        tags: ['Questions'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID вопроса',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Вопрос удалён'),
            new OA\Response(response: 404, description: 'Вопрос не найден')
        ]
    )]

    public function docs() {}
}
