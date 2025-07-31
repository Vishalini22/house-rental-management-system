<!-- REPLACED md:items-center with md:items-start -->
<!-- ADDED pt-1 to the div containing name + created_at -->

<!DOCTYPE html>
<html lang="en" x-data="{ modalOpen: false, modalContent: '', modalType: '' }" @keydown.escape.window="modalOpen = false">
<head>
  <meta charset="UTF-8" />
  <title>Pending House Owners - Rentalz Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

  <aside class="w-64 bg-white p-6 shadow-lg border border-gray-200 min-h-screen hidden md:block" 
         x-data="{ openMenus: { properties: false, customers: false, owners: true } }">
    <h1 class="text-2xl font-bold text-indigo-600 mb-10">Rentalz Admin</h1>
    <nav class="space-y-2">

      <a href="{{ route('admin.dashboard') }}" 
         class="block px-3 py-2 rounded font-medium transition
         {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-800 hover:text-indigo-600' }}">
        Dashboard
      </a>

      <div>
        <button @click="openMenus.properties = !openMenus.properties"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none">
          <span>Properties</span>
          <svg :class="{'transform rotate-180': openMenus.properties}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6"/>
          </svg>
        </button>
        <div x-show="openMenus.properties" x-transition class="mt-1 pl-4 space-y-1" style="display:none;">
          <a href="{{ route('admin.all-properties') }}" 
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
             {{ request()->routeIs('admin.all-properties') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Approved Properties
          </a>
          <a href="{{ route('admin.pending') }}" 
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
             {{ request()->routeIs('admin.pending') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Pending Properties
          </a>
        </div>
      </div>

      <div>
        <button @click="openMenus.customers = !openMenus.customers"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none">
          <span>Customers</span>
          <svg :class="{'transform rotate-180': openMenus.customers}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6"/>
          </svg>
        </button>
        <div x-show="openMenus.customers" x-transition class="mt-1 pl-4 space-y-1" style="display:none;">
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

      <div>
        <button @click="openMenus.owners = !openMenus.owners"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none">
          <span>House Owners</span>
          <svg :class="{'transform rotate-180': openMenus.owners}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6"/>
          </svg>
        </button>
        <div x-show="openMenus.owners" x-transition class="mt-1 pl-4 space-y-1" style="display:none;">
          <a href="{{ route('houseowners.approved') }}" 
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5
             {{ request()->routeIs('houseowners.approved') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Approved
          </a>
          <div class="block text-sm text-gray-400 font-medium px-3 py-1.5 cursor-default select-none rounded" aria-disabled="true">
            Pending
          </div>
        </div>
      </div>

      <a href="{{ route('admin.bookings') }}" 
         class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded
         {{ request()->routeIs('admin.bookings') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
        Booking Requests
      </a>

      <a href="{{ route('admin.contact.messages') }}" 
         class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded
         {{ request()->routeIs('admin.contact.messages') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
        Inquiries
      </a>

      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="block w-full text-left px-3 py-2 rounded font-medium text-gray-800 hover:text-red-600 transition-colors">
          Logout
        </button>
      </form>
    </nav>
  </aside>

  <main class="flex-1 p-8 overflow-auto max-w-screen-xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Pending House Owners</h2>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-6">
        {{ session('success') }}
      </div>
    @endif

    <!-- REPLACED OWNER LISTING START -->
    <div class="space-y-4">
      @forelse($pendingOwners as $owner)
      <div class="bg-white p-4 rounded-md shadow flex flex-col md:flex-row md:items-start md:space-x-6">

        <!-- Profile + name -->
        <div class="flex items-center space-x-4 flex-shrink-0">
          @if($owner->profile_photo && file_exists(public_path('storage/' . $owner->profile_photo)))
            <img src="{{ asset('storage/' . $owner->profile_photo) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500" />
          @else
            <div class="w-12 h-12 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold text-lg">
              {{ strtoupper(substr($owner->name, 0, 1)) }}
            </div>
          @endif
          <div class="pt-1">
            <p class="font-semibold text-gray-900">{{ $owner->name }}</p>
            <p class="text-xs text-gray-500">{{ $owner->created_at->format('d M Y, h:i A') }}</p>
          </div>
        </div>

        <!-- Details grid -->
        <div class="mt-4 md:mt-0 flex-1 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-sm">
          <div>
            <p class="text-gray-400 uppercase font-semibold tracking-wide">Email</p>
            <p class="text-gray-900 truncate">{{ $owner->email }}</p>
          </div>
          <div>
            <p class="text-gray-400 uppercase font-semibold tracking-wide">Phone</p>
            <p class="text-gray-900 truncate">{{ $owner->phone ?? 'N/A' }}</p>
          </div>
          <div>
            <p class="text-gray-400 uppercase font-semibold tracking-wide">Location</p>
            <p class="text-gray-900 break-words">{{ $owner->address ?? 'Unknown' }}</p>
          </div>
          <div>
            <p class="text-gray-400 uppercase font-semibold tracking-wide">Business</p>
            <p class="text-gray-900 italic break-words">{{ $owner->business_details ?? '-' }}</p>
          </div>
        </div>

        <!-- Actions -->
        <div class="mt-4 md:mt-0 flex flex-col items-start md:items-end space-y-2 flex-shrink-0">
          @if($owner->id_proof && file_exists(public_path('storage/' . $owner->id_proof)))
            @php
              $extension = pathinfo(public_path('storage/' . $owner->id_proof), PATHINFO_EXTENSION);
              $proofUrl = asset('storage/' . $owner->id_proof);
              $modalType = strtolower($extension) === 'pdf' ? 'pdf' : 'image';
            @endphp
            <button @click="modalOpen = true; modalContent = '{{ $proofUrl }}'; modalType = '{{ $modalType }}';"
              class="text-indigo-600 hover:underline font-medium text-sm" type="button">
              Show ID
            </button>
          @else
            <p class="text-gray-400 italic text-xs">No ID proof</p>
          @endif

          <form action="{{ route('houseowners.accept', $owner->id) }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-1 rounded text-sm">Accept</button>
          </form>

          <form action="{{ route('houseowners.delete', $owner->id) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-1 rounded text-sm">Delete</button>
          </form>
        </div>

      </div>
      @empty
        <p class="text-center text-gray-600 mt-6">No pending house owners available.</p>
      @endforelse
    </div>
    <!-- REPLACED OWNER LISTING END -->

  </main>
</div>

<!-- Modal for ID Proof -->
<div x-show="modalOpen" x-transition style="display: none;" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4" @click.away="modalOpen = false">
  <div class="bg-white rounded-lg shadow-lg max-w-3xl max-h-[80vh] overflow-auto relative p-4">
    <button @click="modalOpen = false" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl font-bold" aria-label="Close modal">
      &times;
    </button>

    <template x-if="modalType === 'image'">
      <img :src="modalContent" alt="ID Proof Full" class="max-w-full max-h-[75vh] mx-auto" />
    </template>

    <template x-if="modalType === 'pdf'">
      <embed :src="modalContent" type="application/pdf" class="w-full h-[75vh]" />
    </template>
  </div>
</div>

</body>
</html>
