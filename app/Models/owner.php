<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    // Use the rental_system connection
    protected $connection = 'rental_system';

    // Specify the table name if not the plural of model name
    protected $table = 'owners';

    // Add fillable fields if you want mass assignment
    protected $fillable = [
        'name', 'email', 'phone', // etc, your owner table columns
    ];
}
