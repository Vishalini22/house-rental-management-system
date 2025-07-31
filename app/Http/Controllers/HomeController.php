<?php
namespace App\Http\Controllers;

use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        $recentListings = Property::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($property) {
                return [
                    'id' => $property->id,
                    'title' => $property->title,
                    'address' => $property->address,
                    'price' => $property->price,
                    'main_image' => asset('storage/' . $property->image), // ✅ use correct key
                ];
            });

        // ✅ REMOVE dd() — this prevents view from loading
        return view('home', compact('recentListings'));
    }
}
