<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurfaceUser extends Model
{
    use HasFactory, SoftDeletes;

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
}
