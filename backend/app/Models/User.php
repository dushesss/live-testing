<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Определяет, является ли пользователь суперпользователем
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Определяет, является ли пользователь преподавателем
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    /**
     * Определяет, является ли пользователь студентом
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Привязанный преподаватель (если реализована отдельная сущность Teacher)
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
