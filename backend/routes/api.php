<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\InstituteController;
use App\Http\Controllers\Api\LiveTestController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\StudentAnswerController;
use App\Http\Controllers\Api\StudentGroupController;
use App\Http\Controllers\Api\TestAttemptController;
use App\Http\Controllers\Api\UniversityController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('faculties', FacultyController::class);
    Route::apiResource('institutes', InstituteController::class);
    Route::apiResource('student-groups', StudentGroupController::class);
    Route::apiResource('live-tests', LiveTestController::class);
    Route::apiResource('questions', QuestionController::class);
    Route::apiResource('answers', AnswerController::class);
    Route::apiResource('test-attempts', TestAttemptController::class);
    Route::apiResource('student-answers', StudentAnswerController::class);

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('universities', UniversityController::class);
    });
});

