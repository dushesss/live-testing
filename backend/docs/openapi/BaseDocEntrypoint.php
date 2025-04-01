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
final class BaseDocEntrypoint {}
