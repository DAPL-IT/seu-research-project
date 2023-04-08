<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'status'
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower($value))
        );
    }

    public function rent_ads(){
        return $this->hasMany(RentAd::class, 'rent_type_id', 'id')->with(['area', 'poster', 'moderator']);
    }
}
