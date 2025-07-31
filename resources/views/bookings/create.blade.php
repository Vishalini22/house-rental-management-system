@php
  // Load images ordered once at the top
  $allImages = $property->images()->orderBy('order')->get();
  $mainImage = $allImages->firstWhere('is_main', true) ?? $allImages->first();
@endphp



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $property->title }} - Rentalz</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: white;
      margin: 0;
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Navigation Bar -->
  <nav class="bg-white shadow-sm py-4 px-10 flex justify-between items-center">
    <div class="text-2xl font-bold text-gray-800">Rentalz</div>
    <ul class="flex space-x-6 font-medium text-gray-700">
      <li><a href="{{ route('home') }}" class="hover:text-red-500">Home</a></li>
      <li><a href="{{ route('listings') }}" class="text-red-500 font-semibold">Listings</a></li>
      <li><a href="{{ route('about') }}" class="hover:text-red-500">About Us</a></li>
      <li><a href="{{ route('contact') }}" class="hover:text-red-500">Contact</a></li>
    </ul>
    <div class="flex items-center space-x-4">
     
    </div>
  </nav>

  <!-- Property Details -->
  <main class="max-w-6xl mx-auto p-6 mt-8">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      <!-- Image -->
      <div>

@php
  $mainImage = $property->images->firstWhere('is_main', true) ?? $property->images->first();
@endphp

@if($mainImage)
  <img src="{{ asset('storage/' . $mainImage->image_path) }}" alt="{{ $property->title }} - Main Image"
       class="rounded-lg object-cover w-full max-h-[450px]" />
@else
  <div class="w-full h-[450px] bg-gray-100 flex items-center justify-center text-gray-400">
    No Image Available
  </div>
@endif
      


      </div>

      <!-- Property Info -->
      <div>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $property->title }}</h1>

        <ul class="space-y-2 text-gray-700 mb-4">
          <li><strong>Bedrooms:</strong> {{ $property->bedrooms }}</li>
          <li><strong>Bathrooms:</strong> {{ $property->bathrooms }}</li>
          <li><strong>Square Feet:</strong> {{ $property->sqft }}</li>
          <li><strong>Price:</strong> Rs.{{ number_format($property->price) }}/month</li>
          <li><strong>Status:</strong> {{ ucfirst($property->status) }}</li>
        </ul>

        <div class="mb-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-1">Description:</h3>
          <p class="text-gray-700">{{ $property->description }}</p>
        </div>

        <div class="mb-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-1">Owner Information:</h3>
          <p>Name: {{ $property->owner_name }}</p>
          <p>Contact: {{ $property->owner_contact }}</p>
        </div>

        <!-- Book Now Button -->
        <button id="bookNowBtn" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded text-lg font-medium transition duration-200">
          Book Now
        </button>

      </div>
    </div>

    <!-- Booking Form Container (initially hidden unless success message) -->
    <div id="bookingFormContainer" class="max-w-lg mx-auto mt-10 p-6 bg-white border rounded shadow" style="display: none;">
      
      {{-- Success message --}}
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif

      <h2 class="text-2xl font-bold mb-6">Book Property: {{ $property->title }}</h2>

      @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="property_id" value="{{ $property->id }}">

        <div class="mb-5">
          <label for="move_in_date" class="block text-gray-700 font-semibold mb-2">Move-in Date</label>
          <input
            type="date"
            id="move_in_date"
            name="move_in_date"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
            value="{{ old('move_in_date') }}"
          >
        </div>

        <div class="mb-5">
          <label for="duration_months" class="block text-gray-700 font-semibold mb-2">Duration (months)</label>
          <input
            type="number"
            id="duration_months"
            name="duration_months"
            min="1"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
            value="{{ old('duration_months') }}"
          >
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded">
          Submit Booking
        </button>
      </form>
    </div>

    <!-- Back Button -->
    <div class="mt-10 text-center">
      <a href="{{ route('listings') }}" class="text-red-500 hover:text-red-600 font-semibold text-sm">&larr; Back to Listings</a>
    </div>

  </main>

  <script>
    const bookNowBtn = document.getElementById('bookNowBtn');
    const bookingFormContainer = document.getElementById('bookingFormContainer');

    // Show form on click
    bookNowBtn.addEventListener('click', () => {
      bookingFormContainer.style.display = 'block';
      bookNowBtn.style.display = 'none';
      // Scroll to form
      bookingFormContainer.scrollIntoView({ behavior: 'smooth' });
    });

    // If there is a success message, show the form automatically on page load
    @if(session('success'))
      bookingFormContainer.style.display = 'block';
      bookNowBtn.style.display = 'none';
    @endif
  </script>

</body>
</html>
