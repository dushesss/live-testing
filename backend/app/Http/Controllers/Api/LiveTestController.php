<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LiveTestRequest;
use App\Models\LiveTest;
use App\Services\LiveTestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления живыми тестами.
 */
class LiveTestController extends Controller
{
    public function __construct(
        private readonly LiveTestService $service
    ) {
        $this->authorizeResource(LiveTest::class, 'live_test');
    }

    /**
     * Получить список живых тестов (с возможностью поиска по названию).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $tests = $this->service->all($request->get('search'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $tests);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новый живой тест.
     *
     * @param LiveTestRequest $request
     * @return JsonResponse
     */
    public function store(LiveTestRequest $request): JsonResponse
    {
        try {
            $test = $this->service->create($request->validated(), auth()->id());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $test);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получить конкретный живой тест.
     *
     * @param LiveTest $liveTest
     * @return JsonResponse
     */
    public function show(LiveTest $liveTest): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $liveTest);
    }

    /**
     * Обновить живой тест.
     *
     * @param LiveTestRequest $request
     * @param LiveTest $liveTest
     * @return JsonResponse
     */
    public function update(LiveTestRequest $request, LiveTest $liveTest): JsonResponse
    {
        try {
            $updated = $this->service->update($liveTest, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить живой тест.
     *
     * @param LiveTest $liveTest
     * @return JsonResponse
     */
    public function destroy(LiveTest $liveTest): JsonResponse
    {
        try {
            $this->service->delete($liveTest);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
