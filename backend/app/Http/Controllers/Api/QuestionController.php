<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления вопросами.
 */
class QuestionController extends Controller
{
    public function __construct(
        private readonly QuestionService $service
    ) {
        $this->authorizeResource(Question::class, 'question');
    }

    /**
     * Получить список вопросов (с фильтрацией по тексту).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $questions = $this->service->all($request->get('search'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $questions);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новый вопрос.
     *
     * @param QuestionRequest $request
     * @return JsonResponse
     */
    public function store(QuestionRequest $request): JsonResponse
    {
        try {
            $question = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $question);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Получить конкретный вопрос.
     *
     * @param Question $question
     * @return JsonResponse
     */
    public function show(Question $question): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $question);
    }

    /**
     * Обновить вопрос.
     *
     * @param QuestionRequest $request
     * @param Question $question
     * @return JsonResponse
     */
    public function update(QuestionRequest $request, Question $question): JsonResponse
    {
        try {
            $updated = $this->service->update($question, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить вопрос.
     *
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question): JsonResponse
    {
        try {
            $this->service->delete($question);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
