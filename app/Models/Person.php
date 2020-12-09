<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Person extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'other_names',
        'reg_number',
        'email',
        'type',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if current person is student
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->type == 'student';
    }

    /**
     * Check if current person is lecturer
     * @return bool
     */
    public function isLecturer(): bool
    {
        return $this->type == 'lecturer';
    }

    public function getFullName($firstNameLast = false): string
    {
        if ($firstNameLast) {
            return "{$this->other_names} {$this->first_name}";
        }

        return "{$this->first_name} {$this->other_names}";
    }
}
