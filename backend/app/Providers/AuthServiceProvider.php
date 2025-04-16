<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\{Answer, Faculty, Institute, LiveTest, Question, StudentGroup, University, User};
use App\Policies\{AnswerPolicy,
    FacultyPolicy,
    InstitutePolicy,
    LiveTestPolicy,
    QuestionPolicy,
    StudentGroupPolicy,
    UniversityPolicy,
    UserPolicy};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Services\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    protected array $policies = [
        LiveTest::class => LiveTestPolicy::class,
        Answer::class => AnswerPolicy::class,
        Faculty::class => FacultyPolicy::class,
        Institute::class => InstitutePolicy::class,
        Question::class => QuestionPolicy::class,
        StudentGroup::class => StudentGroupPolicy::class,
        University::class => UniversityPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function register(): void
    {
        $this->app->bind(AuthService::class);
    }

    public function boot(): void
    {
        Gate::before(function (User $user, string $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}
