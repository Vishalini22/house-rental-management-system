<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // If needed, define the table name
    protected $table = 'listings'; 

    // Define the fillable fields for mass assignment
    protected $fillable = ['title', 'bedrooms', 'bathrooms', 'sqft', 'price', 'image'];
}
