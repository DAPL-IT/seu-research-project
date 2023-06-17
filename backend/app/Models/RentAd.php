<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentAd extends Model
{
    use HasFactory;

    public const IMAGE_DIR = 'images/rent_ads/';
    protected $appends = ['image_url'];

    protected $fillable = [
        'title',
        'image',
        'price',
        'rooms',
        'bathrooms',
        'floor',
        'square_feet',
        'description',
        'full_address',
        'status',
        'is_featured',
        'sold_on_site',
        'rent_type_id',
        'area_id',
        'poster_id',
        'moderator_id'
    ];

    public function rent_type(){
        return $this->belongsTo(RentType::class, 'rent_type_id', 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'area_id', 'id')->with(['district']);
    }

    public function poster(){
        return $this->belongsTo(SurfaceUser::class, 'poster_id', 'id');
    }

    public function moderator(){
        return $this->belongsTo(User::class, 'moderator_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = url($this->attributes['image']);
        return $imageUrl;
    }
}
