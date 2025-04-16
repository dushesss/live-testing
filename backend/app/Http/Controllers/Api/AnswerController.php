<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Контроллер управления ответами.
 */
class AnswerController extends Controller
{
    public function __construct(
        private readonly AnswerService $service
    ) {
        $this->authorizeResource(Answer::class, 'answer');
    }

    /**
     * Получить список всех ответов (с возможностью поиска по тексту).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $answers = $this->service->all($request->get('search'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $answers);
        } catch (\Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новый ответ.
     *
     * @param AnswerRequest $request
     * @return JsonResponse
     */
    public function store(AnswerRequest $request): JsonResponse
    {
        try {
            $answer = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $answer);
        } catch (\Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Показать конкретный ответ.
     *
     * @param Answer $answer
     * @return JsonResponse
     */
    public function show(Answer $answer): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $answer);
    }

    /**
     * Обновить ответ.
     *
     * @param AnswerRequest $request
     * @param Answer $answer
     * @return JsonResponse
     */
    public function update(AnswerRequest $request, Answer $answer): JsonResponse
    {
        try {
            $updated = $this->service->update($answer, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (\Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить ответ.
     *
     * @param Answer $answer
     * @return JsonResponse
     */
    public function destroy(Answer $answer): JsonResponse
    {
        try {
            $this->service->delete($answer);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (\Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
