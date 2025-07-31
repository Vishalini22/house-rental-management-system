@php
  $allImages = $property->images;
  $mainImage = $property->images->firstWhere('is_main', true) ?? $allImages->first();
  $thumbnailImages = $allImages->filter(fn($img) => $img->id !== optional($mainImage)->id);
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $property->title }} - Rentalz</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
<style>
.lb-nav a.lb-prev {
  background-image: url('data:image/svg+xml;utf8,<svg fill="white" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>') !important;
  width: 60px !important;
  height: 60px !important;
  opacity: 0.8 !important;
}
.lb-nav a.lb-next {
  background-image: url('data:image/svg+xml;utf8,<svg fill="white" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>') !important;
  width: 60px !important;
  height: 60px !important;
  opacity: 0.8 !important;
}
.lb-nav a.lb-prev:hover,
.lb-nav a.lb-next:hover {
  opacity: 1 !important;
}
.lb-nav a {
  top: 50% !important;
  transform: translateY(-50%) !important;
}
</style>

</head>
<body class="bg-white text-gray-800">

  <!-- NAVBAR -->
  <nav class="bg-white shadow-md py-4 px-10 flex justify-between items-center">
    <div class="text-2xl font-bold text-gray-800">Rentalz</div>
    <ul class="flex space-x-6 font-medium text-gray-700">
      <li><a href="{{ route('home') }}" class="hover:text-red-500">Home</a></li>
      <span class="text-red-500 font-semibold cursor-default select-none">Listings</span>
</li>

      <li><a href="{{ route('about') }}" class="hover:text-red-500">About Us</a></li>
      <li><a href="{{ route('contact') }}" class="hover:text-red-500">Contact</a></li>
    </ul>
    <div class="flex items-center space-x-4">
    </div>
  </nav>

  <!-- 🔳 WRAPPER START -->
  <div class="bg-gray-100 py-2">

    <!-- MAIN CONTENT -->
    <main class="max-w-6xl mx-auto p-6 mt-1">

    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 border border-green-300 rounded text-center font-semibold shadow">
      {{ session('success') }}
    </div>
  @endif
      <div class="bg-white rounded-xl shadow-md p-6 space-y-10">

        <div class="md:flex md:space-x-6">
          <!-- IMAGES -->
          <div class="md:w-1/2 space-y-4">
            <div class="w-full h-[230px] rounded-md bg-gray-200 overflow-hidden">
              @if($mainImage)
                <a href="{{ asset('storage/' . $mainImage->image_path) }}"
                   data-lightbox="property-gallery" data-title="{{ $property->title }}">
                  <img src="{{ asset('storage/' . $mainImage->image_path) }}"
                       class="w-full h-full object-cover rounded-md" />
                </a>
              @else
                <p class="text-center text-gray-500 pt-20">No main image available</p>
              @endif
            </div>
            <div class="grid grid-cols-3 gap-3">
              @forelse($thumbnailImages as $img)
                <a href="{{ asset('storage/' . $img->image_path) }}" data-lightbox="property-gallery" data-title="{{ $property->title }}">
                  <img src="{{ asset('storage/' . $img->image_path) }}"
                       class="w-full h-28 object-cover rounded-md hover:ring-2 hover:ring-red-400 transition duration-200" />
                </a>
              @empty
                <p class="col-span-3 text-gray-500">No additional photos available.</p>
              @endforelse
            </div>
          </div>

          <!-- DETAILS -->
          <div class="md:w-1/2 mt-6 md:mt-0 flex flex-col">
            <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>

            <div class="grid grid-cols-2 gap-4 mt-6">
              <!-- Rent -->
              <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-4 0-6 2-6 4s2 4 6 4 6-2 6-4-2-4-6-4z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v4m0 8v4" />
                </svg>
                <div>
                  <div class="text-lg font-semibold text-gray-800">₹{{ number_format($property->price) }}</div>
                  <div class="text-sm text-gray-500">Monthly Rent</div>
                </div>
              </div>
              <!-- Bedrooms -->
              <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7h18M5 7v12m14-12v12M3 17h18" />
                </svg>
                <div>
                  <div class="text-lg font-semibold text-gray-800">{{ $property->bedrooms }}</div>
                  <div class="text-sm text-gray-500">Bedrooms</div>
                </div>
              </div>
              <!-- Bathrooms -->
              <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 19h16M4 15h16M12 3v12" />
                </svg>
                <div>
                  <div class="text-lg font-semibold text-gray-800">{{ $property->bathrooms }}</div>
                  <div class="text-sm text-gray-500">Bathrooms</div>
                </div>
              </div>
              <!-- Area -->
              <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18M8 4l12 12M4 8l12 12" />
                </svg>
                <div>
                  <div class="text-lg font-semibold text-gray-800">{{ $property->sqft }} sq.ft</div>
                  <div class="text-sm text-gray-500">Area</div>
                </div>
              </div>
            </div>

            <div class="pt-6 border-t mt-6 space-y-4 flex-grow">
              <h3 class="text-lg font-semibold text-gray-800">Owner Info</h3>
              <p class="text-gray-700"><strong>Name:</strong> {{ $property->owner_name }}</p>
              <p class="text-gray-700"><strong>Contact:</strong> {{ $property->owner_contact }}</p>
              <p class="text-gray-500 text-sm">Added on: {{ $property->created_at->format('F j, Y, g:i A') }}</p>

              <div>
                <h3 class="text-lg font-semibold text-gray-800">Address</h3>
                <p class="text-gray-700">{{ $property->address }}</p>
              </div>

              <div>
                <h3 class="text-lg font-semibold text-gray-800">Description</h3>
                <p class="text-gray-700">{{ $property->description }}</p>
              </div>

              <div class="mt-6 rounded-lg overflow-hidden border border-gray-300 shadow-sm">
                <iframe
                  src="https://maps.google.com/maps?q={{ urlencode($property->address) }}&output=embed"
                  class="w-full h-[400px]"
                  frameborder="0"
                  allowfullscreen
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Map of {{ $property->address }}">
                </iframe>
              </div>

              <!-- Book Now Button -->
              <button id="bookNowBtn" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg shadow-md font-semibold transition">
                Book Now
              </button>

              <!-- Booking Form (hidden initially) -->
              <div id="bookingFormContainer" class="mt-6 p-6 bg-white border rounded shadow" style="display:none;">
                <form action="{{ route('bookings.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="property_id" value="{{ $property->id }}">

                  <div class="mb-4">
                    <label for="move_in_date" class="block font-semibold text-gray-700">Move-in Date</label>
                    <input type="date" name="move_in_date" id="move_in_date" class="w-full border rounded px-3 py-2" required>
                  </div>

                  <div class="mb-4">
                    <label for="duration_months" class="block font-semibold text-gray-700">Duration (months)</label>
                    <input type="number" name="duration_months" id="duration_months" min="1" class="w-full border rounded px-3 py-2" required>
                  </div>

                  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded font-semibold w-full">
                    Submit Booking
                  </button>
                </form>
              </div>

            </div><!-- /.flex-grow -->
          </div>
        </div>
      </div>
    </main>

    
  
  </div>


    @include('footer')


  <script>
    document.getElementById('bookNowBtn').addEventListener('click', function() {
      this.style.display = 'none';
      document.getElementById('bookingFormContainer').style.display = 'block';
      document.getElementById('move_in_date').focus();
    });
  </script>

  <!-- ✅ Lightbox JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

  <!-- ✅ Optional CSS to make lightbox fullscreen friendly and show arrows clearly -->
  <style>
    .lightboxOverlay {
      background: rgba(0, 0, 0, 0.95) !important;
    }
    .lb-image {
      max-height: 90vh !important;
    }

    /* Make Lightbox arrows visible and bigger */
    .lb-prev, .lb-next {
      filter: invert(100%) brightness(200%) !important;
      opacity: 1 !important;
      width: 60px !important;
      height: 60px !important;
      background-size: 60px 60px !important;
    }
    .lb-nav a {
      top: 50% !important;
      transform: translateY(-50%) !important;
    }
  </style>

</body>
</html>
