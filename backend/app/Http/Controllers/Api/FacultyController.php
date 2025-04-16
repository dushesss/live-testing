<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use App\Services\FacultyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления факультетами.
 */
class FacultyController extends Controller
{
    public function __construct(
        private readonly FacultyService $service
    ) {
        $this->authorizeResource(Faculty::class, 'faculty');
    }

    /**
     * Получить список факультетов (с фильтрацией по названию).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $faculties = $this->service->all($request->get('name'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $faculties);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новый факультет.
     *
     * @param FacultyRequest $request
     * @return JsonResponse
     */
    public function store(FacultyRequest $request): JsonResponse
    {
        try {
            $faculty = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $faculty);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получить конкретный факультет.
     *
     * @param Faculty $faculty
     * @return JsonResponse
     */
    public function show(Faculty $faculty): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $faculty);
    }

    /**
     * Обновить факультет.
     *
     * @param FacultyRequest $request
     * @param Faculty $faculty
     * @return JsonResponse
     */
    public function update(FacultyRequest $request, Faculty $faculty): JsonResponse
    {
        try {
            $updated = $this->service->update($faculty, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить факультет.
     *
     * @param Faculty $faculty
     * @return JsonResponse
     */
    public function destroy(Faculty $faculty): JsonResponse
    {
        try {
            $this->service->delete($faculty);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
