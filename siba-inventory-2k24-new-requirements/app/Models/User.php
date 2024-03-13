<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'epf',
        'name',
        'role',
        'dept_id',
        'isActive',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Function will return role names
    public function getRoleNameAttribute()
    {
        $roles = [
            1 =>'User',
            2 => 'Store Manager',
            3 => 'Purchase Manager',
            4 => 'Head of Administration',
            5 => 'Admin',
            // Add more roles as needed
        ];

        return $roles[$this->attributes['role']] ?? 'Unknown Role';
    }

    // Function will return department name
    public function getDepartmentNameAttribute()
    {
        $departments = [
            1 => 'Information Technology',
            2 => 'Buddhist & Pali Studies',
            3 => 'Counselling Psycology',
            4 => 'English & Modern Language',
            5 => 'Global Studies',
            6 => 'Aesthetic Department',
            7 => 'Management Studies',
            8 => 'Kandyan Dancing',
            9 => 'Admin Department',
            // Add more departments as needed
        ];

        return $departments[$this->attributes['dept_id']] ?? 'Unknown Department';
    }

    public function getIsActiveNameAttribute()
    {
        $status = [
            1 =>'Active',
            2 => 'Deactivated',
            3 => 'Deleted',
            // Add more roles as needed
        ];

        return $status[$this->attributes['isActive']] ?? 'Unknown Status';
    }

}
