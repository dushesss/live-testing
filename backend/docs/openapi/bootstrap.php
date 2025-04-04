<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

new \Docs\Openapi\BaseDocEntrypoint();
new \Docs\Openapi\Http\Controllers\Api\AuthControllerDocs();
new \Docs\Openapi\Http\Controllers\Api\LiveTestControllerDocs();
