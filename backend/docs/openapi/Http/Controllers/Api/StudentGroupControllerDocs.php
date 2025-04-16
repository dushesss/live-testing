<?php
declare(strict_types=1);

namespace Docs\Openapi\Http\Controllers\Api;

use OpenApi\Attributes as OA;

final class StudentGroupControllerDocs
{
    #[OA\Tag(name: 'Student Groups', description: 'CRUD операции со студенческими группами')]

    #[OA\Get(
        path: '/student-groups',
        summary: 'Получить список всех студенческих групп',
        security: [['bearerAuth' => []]],
        tags: ['Student Groups'],
        parameters: [
            new OA\Parameter(
                name: 'name',
                description: 'Фильтрация по названию группы',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Список групп')
        ]
    )]

    #[OA\Post(
        path: '/student-groups',
        summary: 'Создать новую студенческую группу',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'faculty_id'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'ИУ7-31Б'),
                    new OA\Property(property: 'faculty_id', type: 'integer', example: 7),
                ]
            )
        ),
        tags: ['Student Groups'],
        responses: [
            new OA\Response(response: 201, description: 'Группа создана')
        ]
    )]

    #[OA\Get(
        path: '/student-groups/{id}',
        summary: 'Получить конкретную группу',
        security: [['bearerAuth' => []]],
        tags: ['Student Groups'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID группы',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Информация о группе'),
            new OA\Response(response: 404, description: 'Группа не найдена')
        ]
    )]

    #[OA\Put(
        path: '/student-groups/{id}',
        summary: 'Обновить группу',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'ИУ7-41Б'),
                    new OA\Property(property: 'faculty_id', type: 'integer', example: 7),
                ]
            )
        ),
        tags: ['Student Groups'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID группы',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Группа обновлена'),
            new OA\Response(response: 404, description: 'Группа не найдена')
        ]
    )]

    #[OA\Delete(
        path: '/student-groups/{id}',
        summary: 'Удалить группу',
        security: [['bearerAuth' => []]],
        tags: ['Student Groups'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'ID группы',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'Группа удалена'),
            new OA\Response(response: 404, description: 'Группа не найдена')
        ]
    )]

    public function docs() {}
}
