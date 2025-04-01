<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestAttempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'live_test_id',
        'student_name',
        'student_group_id',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function test()
    {
        return $this->belongsTo(LiveTest::class, 'live_test_id');
    }

    public function group()
    {
        return $this->belongsTo(StudentGroup::class, 'student_group_id');
    }
}
