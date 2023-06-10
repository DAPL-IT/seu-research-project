<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class RentClassification extends Model
{
    use HasFactory;

    protected $fillable = [
        'classification',
        'from',
        'to',
        'slug'
    ];

    protected function classification(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower($value))
        );
    }
}
