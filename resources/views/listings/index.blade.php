<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rentalz | Listings</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <style>
    .listing-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .listing-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .listing-title {
      font-family: 'Inter', sans-serif;
    }

    .listing-price {
      font-weight: 600;
      color: #ef4444;
    }

    footer {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

footer.visible {
  opacity: 1;
  transform: translateY(0);
}

  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- Navbar -->
  <nav class="bg-white shadow-sm py-4 px-10 flex justify-between items-center">
    <div class="text-2xl font-bold text-gray-800">Rentalz</div>
    <ul class="flex space-x-6 font-medium text-gray-700">
      <li><a href="{{ route('home') }}" class="hover:text-red-500">Home</a></li>
    <li>
  <span class="text-red-500 font-semibold cursor-default select-none">Listings</span>
</li>

      <li><a href="{{ route('about') }}" class="hover:text-red-500">About Us</a></li>
      <li><a href="{{ route('contact') }}" class="hover:text-red-500">Contact</a></li>
    </ul>
    <div class="flex space-x-4 items-center">
    </div>
  </nav>

  <!-- Header -->
  <header class="max-w-7xl mx-auto flex justify-between items-center py-12 px-6">
    <div>
      <h1 class="text-4xl font-bold text-gray-900 mb-2">Available Rentals</h1>
      <p class="text-gray-600">Explore our listings below</p>
    </div>
  </header>

  <!-- Listings Grid -->
  <main class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pb-16">
    
    @foreach($properties as $property)
      <div class="listing-card bg-white border border-gray-200 rounded-lg overflow-hidden">
        <a href="{{ route('listing.show', $property->id) }}">
          <div class="w-full h-48 overflow-hidden">
 
          @if($property->image)
  <img src="{{ asset('storage/' . $property->image) }}" alt="House Photo" class="w-full h-full object-cover" />
@else
  @php
    $mainImage = $property->images->firstWhere('is_main', 1) ?? $property->images->first();
  @endphp

  @if($mainImage)
    <img src="{{ asset('storage/' . $mainImage->image_path) }}" alt="House Photo" class="w-full h-full object-cover" />
  @endif
@endif


          </div>
        </a>
        <div class="p-4">
          <h3 class="listing-title text-xl text-gray-800">{{ $property->title }}</h3>
          <p class="text-gray-600 text-sm mt-1">{{ $property->bedrooms }} Beds • {{ $property->bathrooms }} Baths • {{ $property->sqft }} sqft</p>
          <p class="listing-price text-lg mt-2">Rs.{{ number_format($property->price) }}/month</p>
          <a href="{{ route('listing.show', $property->id) }}" class="inline-block mt-4 text-red-500 hover:text-red-600 font-medium text-sm">View Details</a>
        </div>
      </div>
    @endforeach

    @if($properties->isEmpty())
      <div class="col-span-full text-center text-gray-500 text-lg">
        No rental properties found.
      </div>
    @endif

  </main>

  <!-- Add Your Listing Button at the Bottom -->
  <div class="max-w-7xl mx-auto px-6 pb-16 text-center">
    <a href="{{ route('owner.page') }}"
       class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded shadow font-semibold inline-block">
      Add Your Listing
    </a>
  </div>

  @include('footer')

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('footer');

    function checkFooterVisibility() {
      const rect = footer.getBoundingClientRect();
      const windowHeight = window.innerHeight || document.documentElement.clientHeight;

      // Check if footer is in viewport
      if (rect.top <= windowHeight && rect.bottom >= 0) {
        footer.classList.add('visible');
      }
    }

    window.addEventListener('scroll', checkFooterVisibility);
    window.addEventListener('resize', checkFooterVisibility);

    // Initial check in case footer is already visible
    checkFooterVisibility();
  });
</script>

</body>
</html>
