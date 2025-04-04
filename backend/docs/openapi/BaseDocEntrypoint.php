<?php
declare(strict_types=1);

namespace Docs\Openapi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'Документация API проекта',
    title: 'Live Testing API'
)]
#[OA\Server(
    url: 'http://live-testing.loc/api',
    description: 'Локальный сервер API'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    description: 'JWT токен авторизации. Получается через /login',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]
final class BaseDocEntrypoint {}
