<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title', 'address', 'price', 'bedrooms', 'bathrooms', 'sqft', 'description', 'image',
        'owner_name', 'owner_contact', 'owner_photo', 'status', 'owner_id'
    ];

    public function owner()
    {
        return $this->belongsTo(HouseOwner::class, 'owner_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order', 'asc');
    }

    public function mainImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_main', true);
    }

   public function getMainOrFirstImageAttribute()
{
    return $this->mainImage()->first() ?? $this->images->first();
}


    
}
