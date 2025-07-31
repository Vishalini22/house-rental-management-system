<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'sqft' => 'required|numeric',
            'description' => 'required|string',
            'images.*' => 'nullable|image|max:2048', // Accept multiple images
            'owner_name' => 'required|string|max:255',
            'owner_contact' => 'required|string|max:255',
            'owner_photo' => 'nullable|image|max:2048',
        ]);

        // Set owner ID and status
        $data['status'] = 'pending';
        $data['owner_id'] = auth()->guard('houseowner')->id();

        // Handle owner photo upload
        if ($request->hasFile('owner_photo')) {
            $data['owner_photo'] = $request->file('owner_photo')->store('owner_photos', 'public');
        }

        // Create the property first (so we get the ID)
        $property = Property::create($data);

        // Handle multiple property images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                $path = $imageFile->store('property_images', 'public');

                // Store first image in the main 'image' column
                if ($index === 0) {
                    $property->update(['image' => $path]);
                }

            PropertyImage::create([
    'property_id' => $property->id,
    'image_path' => $path,
    'is_main' => $index === 0 ? true : false, // mark the first image as main
    'order' => $index, // ✅ this sets the correct order in DB
]);


            }
        }

       return redirect()->back()->with('success', 'Property listed and awaiting approval.');

    }

    public function approve($id)
{
    $property = Property::findOrFail($id);
    $property->status = 'approved'; // or 'active', depending on your setup
    $property->save();

   
      return redirect()->route('admin.pending')->with('success', 'Property has been approved successfully.');


}

public function index()
{
    // Fetch only approved properties
    $properties = Property::where('status', 'approved')->get();

    // Pass properties to listings view
    return view('listings.index', compact('properties'));
}



public function show($id)
{
    $property = Property::with(['images' => function($q) {
        $q->orderBy('order');
    }, 'owner'])->findOrFail($id);

    return view('bookings.create', compact('property'));
}

public function reject($id)
{
    $property = Property::findOrFail($id);
    $property->status = 'rejected';
    $property->save();

    return redirect()->route('admin.pending')->with('success', 'Property has been rejected.');
}



}
