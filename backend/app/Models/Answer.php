<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['text'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'questions_answers')
            ->withPivot('is_correct')
            ->withTimestamps();
    }
}
