<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LiveTestRequest;
use App\Models\LiveTest;
use App\Services\LiveTestService;
use Illuminate\Http\JsonResponse;

class LiveTestController extends Controller
{
    public function __construct(
        private readonly LiveTestService $service
    ) {}

    public function index(): JsonResponse
    {
        $tests = $this->service->all();
        return $this->apiResponse(200, 'success', $tests);
    }

    public function store(LiveTestRequest $request): JsonResponse
    {
        $test = $this->service->create($request->validated(), auth()->id());
        return $this->apiResponse(201, 'success', $test);
    }

    public function show(LiveTest $liveTest): JsonResponse
    {
        $this->authorize('view', $liveTest);
        return $this->apiResponse(200, 'success', $liveTest);
    }

    public function update(LiveTestRequest $request, LiveTest $liveTest): JsonResponse
    {
        $this->authorize('update', $liveTest);

        $updated = $this->service->update($liveTest, $request->validated());
        return $this->apiResponse(200, 'success', $updated);
    }

    public function destroy(LiveTest $liveTest): JsonResponse
    {
        $this->authorize('delete', $liveTest);

        $this->service->delete($liveTest);
        return $this->apiResponse(200, 'success', ['message' => 'Удалено']);
    }
}
