<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class AnswerControllerDocs
{
    #[OA\Tag(name: 'Answers', description: 'CRUD операции с ответами')]

    #[OA\Get(
        path: '/answers',
        summary: 'Получить список всех ответов',
        security: [['bearerAuth' => []]],
        tags: ['Answers'],
        parameters: [
            new OA\Parameter(
                name: 'search',
                description: 'Поиск по тексту ответа',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список ответов')
        ]
    )]

    #[OA\Post(
        path: '/answers',
        summary: 'Создать новый ответ',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['text', 'question_id', 'is_correct'],
                properties: [
                    new OA\Property(property: 'text', type: 'string', example: 'Париж'),
                    new OA\Property(property: 'question_id', type: 'integer', example: 42),
                    new OA\Property(property: 'is_correct', type: 'boolean', example: true),
                ]
            )
        ),
        tags: ['Answers'],
        responses: [
            new OA\Response(response: 201, description: 'Ответ успешно создан')
        ]
    )]

    #[OA\Get(
        path: '/answers/{id}',
        summary: 'Получить конкретный ответ',
        security: [['bearerAuth' => []]],
        tags: ['Answers'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация об ответе'),
            new OA\Response(response: 404, description: 'Ответ не найден')
        ]
    )]

    #[OA\Put(
        path: '/answers/{id}',
        summary: 'Обновить ответ',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'text', type: 'string', example: 'Лондон'),
                    new OA\Property(property: 'is_correct', type: 'boolean', example: false),
                ]
            )
        ),
        tags: ['Answers'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Ответ обновлён'),
            new OA\Response(response: 404, description: 'Ответ не найден')
        ]
    )]

    #[OA\Delete(
        path: '/answers/{id}',
        summary: 'Удалить ответ',
        security: [['bearerAuth' => []]],
        tags: ['Answers'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Ответ удалён'),
            new OA\Response(response: 404, description: 'Ответ не найден')
        ]
    )]

    public function docs() {}
}
