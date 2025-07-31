<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\HouseOwner;
use Carbon\Carbon;
use DB;
use App\Models\Contact;



class AdminController extends Controller
{
    // Pending properties list
    public function showPending()
    {
        $properties = Property::where('status', 'pending')->get();
        return view('admin.pending', compact('properties'));
    }

    // Show property details
    public function show($id)
    {
        $property = Property::with(['images' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->find($id);

        return view('admin.viewdetails', ['property' => $property]);
    }

    // Approve a property
    public function approve($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'approved';
        $property->save();

        return redirect()->back()->with('success', 'Property approved.');
    }

    // Reject a property
    public function reject($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'rejected';
        $property->save();

      return redirect()->route('admin.pending')->with('success', 'Property  rejected ');
    }

   public function storePropertyImages(Request $request, Property $property)
{
    // Validate that 'images' is required and is an array of files
    $request->validate([
        'images' => 'required|array',
        'images.*' => 'image|max:5120', // max 5MB per image, adjust as needed
    ]);

    $files = $request->file('images');
    $lastOrder = $property->images()->max('order') ?? 0;

    foreach ($files as $file) {
        $path = $file->store('property_images', 'public');

        $property->images()->create([
            'image_path' => $path,
            'order' => ++$lastOrder,
            'is_main' => false,
        ]);
    }

    return redirect()->back()->with('success', 'Property images uploaded successfully.');
}

    // Show all bookings
    public function showBookings()
    {
        $bookings = Booking::with('property', 'customer')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    // Mark booking as sent to owner
    public function sendToOwner($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->sent_to_owner = true;
        $booking->save();

        // Optionally send email/notification here

        return redirect()->back()->with('success', 'Booking sent to owner successfully.');
    }
public function dashboard()
{
    // Total property count
    $totalProperties = Property::count();

    // Customer and house owner counts
    $pendingCustomers = Customer::where('status', 'pending')->count();
    $activeCustomers = Customer::where('status', 'approved')->count(); // ✅ Add this

    $pendingHouseOwners = HouseOwner::where('status', 'pending')->count(); // ✅ Add this
    $activeHouseOwners = HouseOwner::where('status', 'approved')->count(); // ✅ Already added

    // Inquiry counts (you may adjust based on your Inquiry model setup)
    $inquiriesSent = Booking::where('sent_to_owner', true)->count();     // ✅ Adjust as needed
    $inquiriesPending = Booking::where('sent_to_owner', false)->count(); // ✅ Adjust as needed

    // Bookings count
    $totalBookings = Booking::count();

    // Properties by status
    $pendingProperties = Property::where('status', 'pending')->count();
    $approvedProperties = Property::where('status', 'approved')->count();
    $rejectedProperties = Property::where('status', 'rejected')->count();

    // Latest updated_at for property
    $lastPropertyUpdate = Property::latest()->value('updated_at');
$latestProperties = Property::with('images')
    ->where('status', 'approved')  // ✅ Only approved listings
    ->latest()
    ->take(6)
    ->get()
    ->map(function ($property) {
        $mainImage = $property->images->firstWhere('is_main', true)
                    ?? $property->images->sortBy('order')->first();

        return [
            'id' => $property->id,
            'title' => $property->title,
            'address' => $property->address,
            'description' => $property->description,
            'main_image' => $mainImage ? asset('storage/' . $mainImage->image_path) : null,
        ];
    });



    $recentMessages = Contact::where('is_read', false)->latest()->take(5)->get();

    // Bookings over the last 6 months
    $today = Carbon::today();
    $sixMonthsAgo = $today->copy()->subMonths(5)->startOfMonth();

    $bookingsDataQuery = Booking::select(
        DB::raw("DATE_FORMAT(created_at, '%b') as month"),
        DB::raw('COUNT(*) as count')
    )
        ->whereBetween('created_at', [$sixMonthsAgo, $today])
        ->groupBy('month')
        ->orderByRaw("MIN(created_at)")
        ->get();

    // Prepare chart labels and values
    $bookingMonths = [];
    $bookingsData = [];

    for ($i = 0; $i < 6; $i++) {
        $monthName = $sixMonthsAgo->copy()->addMonths($i)->format('M');
        $bookingMonths[] = $monthName;

        $monthData = $bookingsDataQuery->firstWhere('month', $monthName);
        $bookingsData[] = $monthData ? $monthData->count : 0;
    }

   return view('admin.dashboard', [
    'totalProperties' => $totalProperties,
    'pendingProperties' => $pendingProperties,
    'approvedProperties' => $approvedProperties,
    'rejectedProperties' => $rejectedProperties,
    'pendingCustomers' => $pendingCustomers,
    'activeCustomers' => $activeCustomers,
    'pendingHouseOwners' => $pendingHouseOwners,
    'activeHouseOwners' => $activeHouseOwners,
    'inquiriesSent' => $inquiriesSent,
    'inquiriesPending' => $inquiriesPending,
    'lastPropertyUpdate' => $lastPropertyUpdate,
    'latestProperties' => $latestProperties,       // ✅ Now added
    'recentMessages' => $recentMessages,           // ✅ Now added
]);

    
}

public function showMessages()
{
    $messages = \App\Models\Contact::orderBy('created_at', 'desc')->get();

    return view('contact', compact('messages'));  // ✅ no "admin." prefix
}

// Property.php model
public function mainImage()
{
    return $this->hasOne(PropertyImage::class)->where('is_main', true);
}


public function allApprovedProperties()
{
    $properties = Property::with('mainImage')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return view('admin.allproperty', compact('properties'));
}

public function showApprovedProperty($id)
{
    $property = Property::with('images')->findOrFail($id);

    return view('admin.allview', compact('property'));
}



}

