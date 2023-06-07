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
    public const SURFACE = 'surface';
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
        'current_address',
        'permanent_address',
        'role',
        'nid',
        'locked',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'nid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() : bool {
        return $this->attributes['role'] === User::ADMIN;
    }

    public function isModerator() : bool {
        return $this->attributes['role'] === User::MODERATOR;
    }

    public function isUser() : bool {
        return $this->attributes['role'] === User::SURFACE;
    }

    public function rent_ads(){
        return $this->hasMany(RentAd::class, 'moderator_id', 'id')->with(['poster', 'rent_type', 'area']);
    }

}
