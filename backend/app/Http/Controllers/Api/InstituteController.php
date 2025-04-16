<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituteRequest;
use App\Models\Institute;
use App\Services\InstituteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления институтами.
 */
class InstituteController extends Controller
{
    public function __construct(
        private readonly InstituteService $service
    ) {
        $this->authorizeResource(Institute::class, 'institute');
    }

    /**
     * Получить список институтов (с фильтрацией по названию).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $institutes = $this->service->all($request->get('name'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $institutes);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новый институт.
     *
     * @param InstituteRequest $request
     * @return JsonResponse
     */
    public function store(InstituteRequest $request): JsonResponse
    {
        try {
            $institute = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $institute);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получить конкретный институт.
     *
     * @param Institute $institute
     * @return JsonResponse
     */
    public function show(Institute $institute): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $institute);
    }

    /**
     * Обновить институт.
     *
     * @param InstituteRequest $request
     * @param Institute $institute
     * @return JsonResponse
     */
    public function update(InstituteRequest $request, Institute $institute): JsonResponse
    {
        try {
            $updated = $this->service->update($institute, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить институт.
     *
     * @param Institute $institute
     * @return JsonResponse
     */
    public function destroy(Institute $institute): JsonResponse
    {
        try {
            $this->service->delete($institute);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
