<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower($value))
        );
    }

    public function areas(){
        return $this->hasMany(Area::class, 'district_id', 'id')->with(['rent_ads']);
    }
}
