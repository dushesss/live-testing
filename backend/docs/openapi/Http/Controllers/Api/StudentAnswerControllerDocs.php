<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class StudentAnswerControllerDocs
{
    #[OA\Tag(name: 'Student Answers', description: 'CRUD операции с ответами студентов')]

    #[OA\Get(
        path: '/student-answers',
        summary: 'Получить список всех ответов студентов',
        security: [['bearerAuth' => []]],
        tags: ['Student Answers'],
        parameters: [
            new OA\Parameter(
                name: 'question_id',
                description: 'Фильтрация по ID вопроса',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'student_id',
                description: 'Фильтрация по ID студента',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список ответов студентов')
        ]
    )]

    #[OA\Post(
        path: '/student-answers',
        summary: 'Создать ответ студента',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['student_id', 'answer_id', 'question_id'],
                properties: [
                    new OA\Property(property: 'student_id', type: 'integer', example: 14),
                    new OA\Property(property: 'answer_id', type: 'integer', example: 87),
                    new OA\Property(property: 'question_id', type: 'integer', example: 12),
                    new OA\Property(property: 'is_selected', type: 'boolean', example: true),
                ]
            )
        ),
        tags: ['Student Answers'],
        responses: [
            new OA\Response(response: 201, description: 'Ответ студента сохранён')
        ]
    )]

    #[OA\Get(
        path: '/student-answers/{id}',
        summary: 'Получить конкретный ответ студента',
        security: [['bearerAuth' => []]],
        tags: ['Student Answers'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID ответа',
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
        path: '/student-answers/{id}',
        summary: 'Обновить ответ студента',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'is_selected', type: 'boolean', example: false),
                ]
            )
        ),
        tags: ['Student Answers'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID ответа',
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
        path: '/student-answers/{id}',
        summary: 'Удалить ответ студента',
        security: [['bearerAuth' => []]],
        tags: ['Student Answers'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID ответа',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Ответ удалён'),
            new OA\Response(response: 404, description: 'Ответ не найден')
        ]
    )]

    public function docs() {}
}
