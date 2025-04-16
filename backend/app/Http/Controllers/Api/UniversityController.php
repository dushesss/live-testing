<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityRequest;
use App\Models\University;
use App\Services\UniversityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления университетами.
 */
class UniversityController extends Controller
{
    public function __construct(
        private readonly UniversityService $service
    ) {
        $this->authorizeResource(University::class, 'university');
    }

    /**
     * Получить список университетов (с фильтрацией по названию).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $universities = $this->service->all($request->get('name'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $universities);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новый университет.
     *
     * @param UniversityRequest $request
     * @return JsonResponse
     */
    public function store(UniversityRequest $request): JsonResponse
    {
        try {
            $university = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $university);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получить конкретный университет.
     *
     * @param University $university
     * @return JsonResponse
     */
    public function show(University $university): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $university);
    }

    /**
     * Обновить университет.
     *
     * @param UniversityRequest $request
     * @param University $university
     * @return JsonResponse
     */
    public function update(UniversityRequest $request, University $university): JsonResponse
    {
        try {
            $updated = $this->service->update($university, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить университет.
     *
     * @param University $university
     * @return JsonResponse
     */
    public function destroy(University $university): JsonResponse
    {
        try {
            $this->service->delete($university);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
