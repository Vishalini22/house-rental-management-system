<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // ✅ Removed the unused $listings array

    public function index()
    {
        // Show only approved properties
        $properties = Property::where('status', 'approved')->get();
        return view('listings.index', compact('properties'));
    }

    public function show($id)
    {
        // Show property by ID
        $property = Property::findOrFail($id);
        return view('listings.show', compact('property'));
    }

    
}
