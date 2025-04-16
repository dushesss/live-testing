<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentAnswerRequest;
use App\Models\StudentAnswer;
use App\Services\StudentAnswerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер управления ответами студентов.
 */
class StudentAnswerController extends Controller
{
    public function __construct(
        private readonly StudentAnswerService $service
    ) {
        $this->authorizeResource(StudentAnswer::class, 'student_answer');
    }

    /**
     * Получить список ответов студентов (с фильтрацией по вопросу).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $answers = $this->service->all($request->get('question_id'));
            return $this->apiResponse(Response::HTTP_OK, 'success', $answers);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Создать новый ответ студента.
     *
     * @param StudentAnswerRequest $request
     * @return JsonResponse
     */
    public function store(StudentAnswerRequest $request): JsonResponse
    {
        try {
            $answer = $this->service->create($request->validated());
            return $this->apiResponse(Response::HTTP_CREATED, 'success', $answer);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Показать конкретный ответ студента.
     *
     * @param StudentAnswer $studentAnswer
     * @return JsonResponse
     */
    public function show(StudentAnswer $studentAnswer): JsonResponse
    {
        return $this->apiResponse(Response::HTTP_OK, 'success', $studentAnswer);
    }

    /**
     * Обновить ответ студента.
     *
     * @param StudentAnswerRequest $request
     * @param StudentAnswer $studentAnswer
     * @return JsonResponse
     */
    public function update(StudentAnswerRequest $request, StudentAnswer $studentAnswer): JsonResponse
    {
        try {
            $updated = $this->service->update($studentAnswer, $request->validated());
            return $this->apiResponse(Response::HTTP_OK, 'success', $updated);
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }

    /**
     * Удалить ответ студента.
     *
     * @param StudentAnswer $studentAnswer
     * @return JsonResponse
     */
    public function destroy(StudentAnswer $studentAnswer): JsonResponse
    {
        try {
            $this->service->delete($studentAnswer);
            return $this->apiResponse(Response::HTTP_NO_CONTENT, 'success');
        } catch (Throwable $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'error', $e->getMessage());
        }
    }
}
