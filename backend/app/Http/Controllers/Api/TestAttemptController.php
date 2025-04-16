<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestAttemptRequest;
use App\Models\TestAttempt;
use App\Services\TestAttemptService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления попытками прохождения тестов.
 */
class TestAttemptController extends Controller
{
    public function __construct(
        private readonly TestAttemptService $service
    ) {
        $this->authorizeResource(TestAttempt::class, 'test_attempt');
    }

    /**
     * Получить список попыток (с фильтрацией по студенту или тесту).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $attempts = $this->service->all($request->get('student_id'), $request->get('live_test_id'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $attempts);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новую попытку.
     *
     * @param TestAttemptRequest $request
     * @return JsonResponse
     */
    public function store(TestAttemptRequest $request): JsonResponse
    {
        try {
            $attempt = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $attempt);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получить конкретную попытку.
     *
     * @param TestAttempt $testAttempt
     * @return JsonResponse
     */
    public function show(TestAttempt $testAttempt): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $testAttempt);
    }

    /**
     * Обновить попытку.
     *
     * @param TestAttemptRequest $request
     * @param TestAttempt $testAttempt
     * @return JsonResponse
     */
    public function update(TestAttemptRequest $request, TestAttempt $testAttempt): JsonResponse
    {
        try {
            $updated = $this->service->update($testAttempt, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить попытку.
     *
     * @param TestAttempt $testAttempt
     * @return JsonResponse
     */
    public function destroy(TestAttempt $testAttempt): JsonResponse
    {
        try {
            $this->service->delete($testAttempt);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
