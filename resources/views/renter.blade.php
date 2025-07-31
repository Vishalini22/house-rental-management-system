@php
  use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up as Customer - Rentalz</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
  <div class="max-w-2xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-indigo-600 mb-6 text-center">
      👤 Customer Sign Up
    </h2>
@if(session('success'))
  <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
  </div>
@endif

    {{-- Display all validation errors --}}
    @if ($errors->any())
      <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
      @csrf

      <!-- Full Name -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Priya Sharma"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror" required>
        @error('name')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="e.g., priya@example.com"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror" required>
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Phone Number -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="e.g., 9876543210"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('phone') border-red-500 @enderror" required>
        @error('phone')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Preferred Location -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Location</label>
        <input type="text" name="preferred_location" value="{{ old('preferred_location') }}" placeholder="e.g., Andheri, Mumbai"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('preferred_location') border-red-500 @enderror">
        @error('preferred_location')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" placeholder="Choose a secure password"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror" required>
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Repeat your password"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Upload Profile Picture -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Profile Picture</label>
        <input type="file" name="profile_photo" accept="image/*"
               class="w-full border rounded-md px-4 py-2 bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-indigo-600 file:text-white hover:file:bg-indigo-700"/>
        <p class="text-sm text-gray-500 mt-1"></p>
        @error('profile_photo')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
          Register as Customer
        </button>
      </div>
    </form>

    <!-- Sign in here link moved BELOW the form -->
    <p class="text-center mt-6 text-sm">
      Already have an account? 
    <a href="/customerlogin" class="text-indigo-600 hover:underline font-medium">Sign in here</a>


    </p>
  </div>
</body>
</html>
