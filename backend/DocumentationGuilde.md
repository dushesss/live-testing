# Инструкция по описанию API-документации с `swagger-php`

Эта инструкция поможет пошагово создавать и подключать документацию к REST API, используя [zircote/swagger-php](https://github.com/zircote/swagger-php), с выносом аннотаций в отдельные PHP-классы.

---

## Шаг 1: Создание класса документации

Создать новый PHP-файл в директории `docs/openapi`, строго соблюдая PSR-4.

Пример: `docs/openapi/AuthLoginDoc.php`

```php
<?php
declare(strict_types=1);

namespace Docs\Openapi;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/auth/login',
    summary: 'Авторизация пользователя',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['login', 'password'],
            properties: [
                new OA\Property(property: 'login', type: 'string', example: 'testuser'),
                new OA\Property(property: 'password', type: 'string', example: 'secret123'),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: 'Успешный вход'),
        new OA\Response(response: 422, description: 'Неверный логин или пароль'),
    ]
)]
final class AuthLoginDoc {}
```

---

## Шаг 2: Создание основного класса документации (единожды)

Создать файл `docs/openapi/BaseDocEntrypoint.php`, в котором будет общая информация о документации:

```php
<?php
declare(strict_types=1);

namespace Docs\Openapi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Live Testing API',
    description: 'Документация API проекта'
)]
#[OA\Server(
    url: '/api',
    description: 'Локальный сервер API'
)]
final class BaseDocEntrypoint {}
```

---

## Шаг 3: Подключение классов в `bootstrap.php`

Создать файл `docs/openapi/bootstrap.php` с подключением всех файлов документации:

```php
<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

new \Docs\Openapi\BaseDocEntrypoint();
new \Docs\Openapi\AuthLoginDoc();
```

> Важно: пути и названия классов должны строго соответствовать PSR-4 и структуре `composer.json`

---

##  Шаг 4: Обновление `composer.json`

Убедиться в прописанном автолоадинге для документации:

```json
"autoload-dev": {
    "psr-4": {
        "Docs\\Openapi\\": "docs/openapi/"
    }
}
```

---

## Шаг 5: Генерация документации

Сначала обновите автолоадер:

```bash
composer dump-autoload
```

Затем сгенерируйте документацию:

```bash
composer swagger-generate
```

Файл `public/docs/openapi.json` будет содержать актуальную OpenAPI-документацию.

---

## Пример полного списка аннотированных файлов

```bash
docs/openapi/
├── AuthLoginDoc.php
├── AuthRegisterDoc.php
├── AuthLogoutDoc.php
├── AuthUserDoc.php
├── BaseDocEntrypoint.php
├── bootstrap.php
```

---

## Рекомендации

- Каждый класс — один endpoint.
- Не смешивайте Swagger-аннотации с кодом контроллеров (во избежание появления визуального шума).
- Следите за соответствием пространства имён и путей файлов.
