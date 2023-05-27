<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class SurfaceUser extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'nid',
        'locked',
        'online',
        'token',
        'email_verified_at',
        'current_address',
        'permanent_address',
    ];

    protected $hidden = [
        'password',
        'nid',
        'token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rent_ads(){
        return $this->hasMany(RentAd::class, 'poster_id', 'id')->with(['area', 'rent_type', 'moderator']);
    }
}
