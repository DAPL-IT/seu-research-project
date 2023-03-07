<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const ADMIN = 'admin';
    public const MODERATOR = 'moderator';
    public const ADMIN_IMAGE_DIR = 'images/admin/';
    public const MODERATOR_IMAGE_DIR = 'images/moderator/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'current_addr',
        'permanent_address',
        'role',
        'nid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(string $role) : bool {
        return $role === User::ADMIN;
    }

    public function isModerator(string $role) : bool {
        return $role === User::MODERATOR;
    }

    public function isAdPoster(string $role) : bool {
        return $role === User::AD_POSTER;
    }
}
