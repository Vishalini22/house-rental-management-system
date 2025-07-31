<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\Contact; // ✅ Make sure model name is correct

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($request->only(['name', 'email', 'message']));

        return back()->with('status', 'Message sent successfully!');
    }

    public function showMessages()
{
    $messages = Contact::latest()->get();  // Fetch all messages ordered by latest first

    return view('admin.contactmessage', compact('messages'));
}


    public function markAsRead($id)
{
    DB::table('contact_messages')->where('id', $id)->update(['is_read' => 1]);

    return back()->with('success', 'Message marked as read.');
}
}
