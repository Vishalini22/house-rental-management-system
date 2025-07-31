<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class HouseOwner extends Authenticatable
{
    use Notifiable;

    protected $table = 'house_owners';  // optional if table name is 'house_owners'

   protected $guard_name = 'houseowner'; // if using Spatie permissions or custom guards


    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'business_details',
        'id_proof',
        'profile_photo',
        'status',  // e.g., 'pending', 'approved'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function properties()
{
    return $this->hasMany(Property::class, 'owner_id');
}

}
