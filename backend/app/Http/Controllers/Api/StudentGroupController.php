<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentGroupRequest;
use App\Models\StudentGroup;
use App\Services\StudentGroupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления студенческими группами.
 */
class StudentGroupController extends Controller
{
    public function __construct(
        private readonly StudentGroupService $service
    ) {
        $this->authorizeResource(StudentGroup::class, 'student_group');
    }

    /**
     * Получить список студенческих групп (с фильтрацией по названию).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $groups = $this->service->all($request->get('name'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $groups);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новую студенческую группу.
     *
     * @param StudentGroupRequest $request
     * @return JsonResponse
     */
    public function store(StudentGroupRequest $request): JsonResponse
    {
        try {
            $group = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $group);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получить конкретную студенческую группу.
     *
     * @param StudentGroup $studentGroup
     * @return JsonResponse
     */
    public function show(StudentGroup $studentGroup): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $studentGroup);
    }

    /**
     * Обновить студенческую группу.
     *
     * @param StudentGroupRequest $request
     * @param StudentGroup $studentGroup
     * @return JsonResponse
     */
    public function update(StudentGroupRequest $request, StudentGroup $studentGroup): JsonResponse
    {
        try {
            $updated = $this->service->update($studentGroup, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить студенческую группу.
     *
     * @param StudentGroup $studentGroup
     * @return JsonResponse
     */
    public function destroy(StudentGroup $studentGroup): JsonResponse
    {
        try {
            $this->service->delete($studentGroup);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
