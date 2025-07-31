<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($propertyid)
    {
        $property = Property::findOrFail($propertyid);
        return view('bookings.create', compact('property'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'move_in_date' => 'required|date',
            'duration_months' => 'required|integer|min:1',
        ]);

        Booking::create([
            'property_id' => $request->property_id,
            'customer_id' => Auth::guard('customer')->id(),
  // make sure you're using the customer guard
            'move_in_date' => $request->move_in_date,
            'duration_months' => $request->duration_months,
        ]);

        return redirect()->back()->with('success', 'Your booking is received. We will reach out to you soon with further details.');


    }
}
