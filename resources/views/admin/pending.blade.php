@php
  use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rentalz Admin - Pending Propertis</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="//unpkg.com/alpinejs" defer></script>
  
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">


    <aside class="w-64 bg-white p-6 shadow-lg border border-gray-200 min-h-screen hidden md:block"
       x-data="{ openMenus: { properties: true, customers: false, owners: false } }">
  <h1 class="text-2xl font-bold text-indigo-600 mb-10">Rentalz Admin</h1>
  <nav class="space-y-2">

    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}"
       class="block px-3 py-2 rounded font-medium transition
       {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-800 hover:text-indigo-600' }}">
      Dashboard
    </a>

    <!-- Properties Dropdown -->
    <div>
      <button
        @click="openMenus.properties = !openMenus.properties"
        class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
        aria-expanded="true"
        :aria-expanded="openMenus.properties.toString()"
      >
        <span>Properties</span>
        <svg :class="{'transform rotate-180': openMenus.properties}" class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div x-show="openMenus.properties" x-transition class="mt-1 pl-4 space-y-1">
        <a href="{{ route('admin.all-properties') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
           {{ request()->routeIs('admin.all-properties') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
          Approved Properties
        </a>

        <!-- Disabled link -->
        <div class="block text-sm text-gray-400 font-medium px-3 py-1.5 rounded cursor-default select-none" aria-disabled="true">
          Pending Properties
        </div>
      </div>
    </div>

    <!-- Customers Dropdown -->
    <div>
      <button
        @click="openMenus.customers = !openMenus.customers"
        class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
      >
        <span>Customers</span>
        <svg :class="{'transform rotate-180': openMenus.customers}" class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div x-show="openMenus.customers" x-transition class="mt-1 pl-4 space-y-1" style="display: none;">
        <a href="{{ route('admin.customers.active') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
           {{ request()->routeIs('admin.customers.active') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
          Active
        </a>
        <a href="{{ route('admin.customers.pending') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
           {{ request()->routeIs('admin.customers.pending') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
          Pending
        </a>
      </div>
    </div>

    <!-- House Owners Dropdown -->
    <div>
      <button
        @click="openMenus.owners = !openMenus.owners"
        class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
      >
        <span>House Owners</span>
        <svg :class="{'transform rotate-180': openMenus.owners}" class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div x-show="openMenus.owners" x-transition class="mt-1 pl-4 space-y-1" style="display: none;">
        <a href="{{ route('houseowners.approved') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
           {{ request()->routeIs('houseowners.approved') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
          Approved
        </a>
        <a href="{{ route('houseowners.pending') }}"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
           {{ request()->routeIs('houseowners.pending') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
          Pending
        </a>
      </div>
    </div>

    <!-- Booking Requests -->
    <a href="{{ route('admin.bookings') }}"
       class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded
       {{ request()->routeIs('admin.bookings') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
      Booking Requests
    </a>

    <!-- Inquiries -->
    <a href="{{ route('admin.contact.messages') }}"
       class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded
       {{ request()->routeIs('admin.contact.messages') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
      Inquiries
    </a>
<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit"
        class="block w-full text-left px-3 py-2 rounded font-medium text-gray-800 hover:text-red-600 transition-colors">
        Logout
    </button>
</form>

  </nav>
</aside>


    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-50 overflow-y-auto">
      <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Pending Properties</h2>
        <div class="text-right">
          
        </div>
      </div>
      

      <!-- Removed Tabs -->
       @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-6">
      {{ session('success') }}
    </div>
  @endif

      <!-- Property Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($properties as $property)
        <div class="bg-white rounded-xl shadow-md p-5 border border-gray-200">
          <!-- House Image -->
          @if($property->image)
            <img src="{{ asset('storage/' . $property->image) }}" alt="House Photo" class="w-full h-40 object-cover rounded-md mb-3">
          @endif

          <h3 class="text-lg font-bold text-indigo-600 mb-1">{{ $property->title }}</h3>
          <p class="text-sm text-gray-700 mb-1">{{ Str::limit($property->description, 100) }}</p>
          <p class="text-xs text-gray-500 mb-2">Status: <span class="font-medium capitalize">{{ $property->status }}</span></p>

          <!-- Owner Info -->
          <div class="flex items-center space-x-3 mb-4">
            @if($property->owner_photo)
              <img src="{{ asset('storage/' . $property->owner_photo) }}" alt="Owner Photo" class="w-10 h-10 rounded-full object-cover">
            @endif
            <div>
              <p class="text-sm font-semibold text-gray-800">{{ $property->owner_name }}</p>
              <p class="text-xs text-gray-500">{{ $property->owner_contact }}</p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex items-center space-x-3">
            <a href="{{ route('admin.properties.show', $property->id) }}"
              class="text-sm text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
              View Details
            </a>

            <form method="POST" action="{{ route('admin.properties.approve', $property->id) }}">
              @csrf
              <button type="submit" class="text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                Approve
              </button>
            </form>

            <form method="POST" action="{{ route('admin.properties.reject', $property->id) }}">
              @csrf
              <button type="submit" class="text-sm bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                Reject
              </button>
            </form>
          </div>
        </div>
        @empty
          <div class="col-span-full text-center text-gray-500 text-lg">
            No pending properties found.
          </div>
        @endforelse
      </div>
    </main>
  </div>
</body>
</html>
