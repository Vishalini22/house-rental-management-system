<?php

namespace App\Http\Controllers;

use App\Models\HouseOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HouseOwnerController extends Controller
{
    public function store(Request $request)
{
    \Log::info('HouseOwnerController@store called');

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:house_owners,email',
        'phone' => 'nullable|string|max:20',
        'password' => 'required|string|confirmed|min:6',
        'address' => 'nullable|string|max:255',
        'business_details' => 'nullable|string|max:255',
        'id_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
    ]);

    \Log::info('Validated data:', $data);

    if ($request->hasFile('id_proof')) {
        $data['id_proof'] = $request->file('id_proof')->store('idproofs', 'public');
    }

    $data['password'] = Hash::make($data['password']);
    $data['status'] = 'pending';

    try {
        $houseOwner = HouseOwner::create($data);
        \Log::info('HouseOwner created with ID: ' . $houseOwner->id);
    } catch (\Exception $e) {
        \Log::error('Error creating HouseOwner: ' . $e->getMessage());
        return redirect()->back()->withErrors('Failed to create house owner.');
    }

    return redirect()->back()->with('success', 'Your details have been submitted. Please wait for admin approval');
}


    public function pendingOwners()
{
    $pendingOwners = HouseOwner::where('status', 'pending')->get();
    return view('admin.pendhouseowner', compact('pendingOwners'));
}


    public function create()
{
    return view('Houseowner');  // Make sure the view name matches exactly
}

    // Accept a house owner
    public function accept($id)
    {
        $owner = HouseOwner::findOrFail($id);
        $owner->status = 'approved';
        $owner->save();

        return redirect()->route('houseowners.pending')->with('success', 'House owner accepted.');
    }

    public function approvedOwners()
{
    $acceptedOwners = HouseOwner::where('status', 'approved')->get();
    return view('admin.acceptedhouseowners', compact('acceptedOwners'));
}


    // Delete a house owner
    public function delete($id)
    {
        $owner = HouseOwner::findOrFail($id);

        if ($owner->profile_photo) {
            Storage::disk('public')->delete($owner->profile_photo);
        }

        if ($owner->id_proof) {
            Storage::disk('public')->delete($owner->id_proof);
        }

        $owner->delete();

        return redirect()->route('houseowners.pending')->with('success', 'House owner deleted.');
    }

 
}
