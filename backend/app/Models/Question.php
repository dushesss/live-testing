<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['text'];

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'questions_answers')
            ->withPivot('is_correct')
            ->withTimestamps();
    }

    public function liveTests()
    {
        return $this->belongsToMany(LiveTest::class, 'live_tests_questions')
            ->withTimestamps();
    }
}
