@php
  $allImages = $property->images()->orderBy('order')->get();
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
  <script src="//unpkg.com/alpinejs" defer></script>

</head>
<style>
  aside {
    background-color: white !important;
  }
</style>

<body class="bg-gray-100 flex min-h-screen">

  <aside class="w-64 bg-white p-6 shadow-lg border border-gray-200 min-h-screen hidden md:block"
       x-data="{ openMenus: { properties: false, customers: false, owners: false } }"
       x-cloak>
  <h1 class="text-2xl font-bold text-indigo-600 mb-10">Rentalz Admin</h1>
  <nav class="space-y-2">

    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}"
       class="block px-3 py-2 rounded font-medium text-gray-800 hover:text-indigo-600 transition">
      Dashboard
    </a>

    <!-- Properties Dropdown -->
    <div>
      <button
        @click="openMenus.properties = !openMenus.properties"
        class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
        type="button"
      >
        <span>Properties</span>
        <svg :class="{'transform rotate-180': openMenus.properties}" class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div x-show="openMenus.properties" x-transition
           class="mt-1 pl-4 space-y-1"
           x-cloak>
        <a href="{{ route('admin.all-properties') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">
          Approved Properties
        </a>
        <a href="{{ route('admin.pending') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">
          Pending Properties
        </a>
      </div>
    </div>

    <!-- Customers Dropdown -->
    <div>
      <button
        @click="openMenus.customers = !openMenus.customers"
        class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
        type="button"
      >
        <span>Customers</span>
        <svg :class="{'transform rotate-180': openMenus.customers}" class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div x-show="openMenus.customers" x-transition
           class="mt-1 pl-4 space-y-1"
           x-cloak>
        <a href="{{ route('admin.customers.active') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">
          Active
        </a>
        <a href="{{ route('admin.customers.pending') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">
          Pending
        </a>
      </div>
    </div>

    <!-- House Owners Dropdown -->
    <div>
      <button
        @click="openMenus.owners = !openMenus.owners"
        class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
        type="button"
      >
        <span>House Owners</span>
        <svg :class="{'transform rotate-180': openMenus.owners}" class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div x-show="openMenus.owners" x-transition
           class="mt-1 pl-4 space-y-1"
           x-cloak>
        <a href="{{ route('houseowners.approved') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">
          Approved
        </a>
        <a href="{{ route('houseowners.pending') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">
          Pending
        </a>
      </div>
    </div>

    <!-- Booking Requests -->
    <a href="{{ route('admin.bookings') }}"
       class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">
      Booking Requests
    </a>

     <a href="{{ route('admin.contact.messages') }}" class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">Inquiries</a>

    <!-- Logout -->
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit"
              class="block w-full text-left px-3 py-2 rounded font-medium text-gray-800 hover:text-red-600 transition-colors">
        Logout
      </button>
    </form>

  </nav>
</aside>

<nav class="mt-6 mb-4 ml-6">
  <a href="{{ route('admin.all-properties') }}" class="text-indigo-600 hover:underline font-semibold">
    ← Back to Approved Properties
  </a>
</nav>


<main style="position: relative; left: -180px;" class="flex-1 max-w-4xl mx-auto px-4 py-1 mt-20 mb-40 bg-white rounded-xl shadow-md">

    @if(session('success'))
      <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 border border-green-300 rounded text-center font-semibold shadow">
        {{ session('success') }}
      </div>
    @endif

    <div class="space-y-10">
      <div class="md:flex md:space-x-6">
        <!-- IMAGES -->
        <div class="md:w-1/2 space-y-4">
         <div class="w-full h-[230px] rounded-md bg-gray-200 overflow-hidden mt-4">

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
          <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $property->title }}</h1>


          <div class="grid grid-cols-2 gap-4 mt-6">
            <!-- Rent -->
            <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
              <div>
                <div class="text-lg font-semibold text-gray-800">₹{{ number_format($property->price) }}</div>
                <div class="text-sm text-gray-500">Monthly Rent</div>
              </div>
            </div>
            <!-- Bedrooms -->
            <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
              <div>
                <div class="text-lg font-semibold text-gray-800">{{ $property->bedrooms }}</div>
                <div class="text-sm text-gray-500">Bedrooms</div>
              </div>
            </div>
            <!-- Bathrooms -->
            <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
              <div>
                <div class="text-lg font-semibold text-gray-800">{{ $property->bathrooms }}</div>
                <div class="text-sm text-gray-500">Bathrooms</div>
              </div>
            </div>
            <!-- Area -->
            <div class="flex items-center space-x-2 bg-gray-50 rounded-lg p-4">
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
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Lightbox JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
  <style>
    .lightboxOverlay {
      background: rgba(0, 0, 0, 0.95) !important;
    }
    .lb-image {
      max-height: 90vh !important;
    }
  </style>

</body>
</html>
