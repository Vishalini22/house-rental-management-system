@php
  $property->load('images'); // force reload fresh from DB
  $allImages = $property->images()->orderBy('order')->get();
  $mainImage = $property->images->firstWhere('is_main', true) ?? $allImages->first();
  $isPending = ($property->status === 'pending');
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Property Details - Admin | {{ $property->title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
  <script src="//unpkg.com/alpinejs" defer></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    #sortable-images > div:focus { outline: none; }
    .cursor-grab { cursor: grab; }
    .cursor-grabbing { cursor: grabbing; }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 flex min-h-screen">

 
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



  <main class="flex-1 max-w-6xl mx-auto p-6 mt-4 flex flex-col">
<!-- Removed Tabs -->
@if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-6">
    {{ session('success') }}
  </div>
@endif


    <nav class="mb-6">
      <a href="{{ route('admin.pending-properties') }}" class="text-indigo-600 hover:underline font-semibold">← Back to Pending Properties</a>
    </nav>

    <div class="bg-white rounded-xl shadow-md p-6 space-y-10 flex-grow">
      <div class="md:flex md:space-x-6">
        <!-- Left Column: Image Section -->
        <div class="md:w-1/2 flex flex-col">
          <!-- Main Image -->
          <div id="big-image-preview" class="w-full h-[320px] rounded-md bg-gray-200 overflow-hidden mb-4 flex items-center justify-center">
            @if($mainImage)
              <a id="big-image-link" href="{{ asset('storage/' . $mainImage->image_path) }}" data-lightbox="property-gallery" data-title="{{ $property->title }}">
                <img src="{{ asset('storage/' . $mainImage->image_path) }}" id="big-image" class="w-full h-full object-cover rounded-md" alt="Main property image" />
              </a>
            @else
              <p class="text-center text-gray-500">No images available</p>
            @endif
          </div>

          <div id="sortable-images"
               data-property-id="{{ $property->id }}"
               class="flex space-x-3 overflow-x-auto p-3 border border-gray-300 rounded select-none {{ $isPending ? 'cursor-grab' : 'cursor-default' }}">

            @foreach($allImages as $img)
              <div data-id="{{ $img->id }}"
                   tabindex="0"
                   draggable="{{ $isPending ? 'true' : 'false' }}"
                   class="relative flex-shrink-0 border-4 rounded-md {{ $loop->first ? 'border-indigo-600' : 'border-transparent' }} hover:border-indigo-400 transition"
                   style="width: 120px; height: 80px;"
                   title="{{ $loop->first ? ($isPending ? 'Main Image (Drag to reorder)' : 'Main Image') : ($isPending ? 'Drag to reorder' : '') }}">
                <img src="{{ asset('storage/' . $img->image_path) }}"
                     alt="Property image"
                     class="w-full h-full object-cover rounded-md cursor-pointer"
                     data-full="{{ asset('storage/' . $img->image_path) }}"
                     data-title="{{ $property->title }}" />
                @if($loop->first)
                  <span class="absolute top-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Main</span>
                @endif
              </div>
            @endforeach
          </div>
        </div>

        <!-- DETAILS -->
        <div class="md:w-1/2 mt-6 md:mt-0 flex flex-col">
          <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>

          <div class="grid grid-cols-2 gap-4 mt-6">
            <!-- Optional rent / bedroom / etc. -->
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
              <iframe src="https://maps.google.com/maps?q={{ urlencode($property->address) }}&output=embed"
                      class="w-full h-[400px]" frameborder="0" allowfullscreen loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade" title="Map of {{ $property->address }}">
              </iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if ($isPending)
      <div class="mt-8 flex space-x-4 justify-center">
        <form method="POST" action="{{ route('admin.properties.approve', $property->id) }}">
          @csrf
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold shadow">Approve</button>
        </form>
        <form method="POST" action="{{ route('admin.properties.reject', $property->id) }}">
          @csrf
          <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold shadow">Reject</button>
        </form>
      </div>
    @endif
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

  @if ($isPending)
  <script>
  document.addEventListener('DOMContentLoaded', () => {
  const sortableEl = document.getElementById('sortable-images');
  const bigImage = document.getElementById('big-image');
  const bigImageLink = document.getElementById('big-image-link');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  function updateBigImage(src, title, highlightDiv) {
    bigImage.src = src;
    bigImage.alt = title;
    bigImageLink.href = src;
    bigImageLink.setAttribute('data-title', title);

    sortableEl.querySelectorAll('div').forEach(div => {
      div.classList.remove('border-indigo-600');
      div.classList.add('border-transparent');
      const tag = div.querySelector('span');
      if (tag) tag.remove();
    });

    highlightDiv.classList.remove('border-transparent');
    highlightDiv.classList.add('border-indigo-600');
    const span = document.createElement('span');
    span.className = 'absolute top-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded';
    span.textContent = 'Main';
    highlightDiv.appendChild(span);
  }

  sortableEl.querySelectorAll('img').forEach(img => {
    img.addEventListener('click', e => {
      e.preventDefault();
      const src = img.getAttribute('data-full');
      const title = img.getAttribute('data-title');
      const clickedDiv = img.closest('div');
      sortableEl.prepend(clickedDiv);
      updateBigImage(src, title, clickedDiv);

      const orderedIds = [...sortableEl.querySelectorAll('[data-id]')].map(el => el.dataset.id);
      const propertyId = sortableEl.dataset.propertyId;

      fetch(`/admin/property/${propertyId}/images/reorder`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ order: orderedIds, main_image_id: orderedIds[0], property_id: propertyId }),
      });
    });  // <-- THIS CLOSING PARENTHESIS WAS MISSING
  });

  new Sortable(sortableEl, {
    animation: 150,
    direction: 'horizontal',
    swapThreshold: 0.65,
    onEnd: () => {
      const orderedIds = [...sortableEl.querySelectorAll('[data-id]')].map(el => el.dataset.id);
      const propertyId = sortableEl.dataset.propertyId;
      const newMain = sortableEl.querySelector('[data-id]');
      const newSrc = newMain.querySelector('img').dataset.full;
      const newTitle = newMain.querySelector('img').dataset.title;
      updateBigImage(newSrc, newTitle, newMain);

      fetch(`/admin/property/${propertyId}/images/reorder`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ order: orderedIds, main_image_id: orderedIds[0], property_id: propertyId }),
      });
    }
  });
});

  </script>
  @else
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sortableEl = document.getElementById('sortable-images');
      const bigImage = document.getElementById('big-image');
      const bigImageLink = document.getElementById('big-image-link');

      sortableEl.querySelectorAll('img').forEach(img => {
        img.addEventListener('click', e => {
          e.preventDefault();
          const src = img.dataset.full;
          const title = img.dataset.title;
          bigImage.src = src;
          bigImage.alt = title;
          bigImageLink.href = src;
          bigImageLink.setAttribute('data-title', title);
        });

        img.setAttribute('draggable', 'false');
      });

      sortableEl.querySelectorAll('[data-id]').forEach(div => {
        div.setAttribute('draggable', 'false');
        div.addEventListener('dragstart', e => e.preventDefault());
      });
    });
  </script>
  @endif

</body>
</html>
