<!DOCTYPE html>
<html lang="en" x-data="{ modalOpen: false, modalContent: '', modalType: '' }" @keydown.escape.window="modalOpen = false">
<head>
  <meta charset="UTF-8" />
  <title>Customer Inquiries - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

  <aside class="w-64 bg-white p-6 shadow-lg border border-gray-200 min-h-screen hidden md:block"
       x-data="{ openMenus: { properties: false, customers: false, owners: false } }">
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
      >
        <span>Properties</span>
        <svg :class="{'transform rotate-180': openMenus.properties}" class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div x-show="openMenus.properties" x-transition class="mt-1 pl-4 space-y-1" style="display: none;">
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

       <div class="block text-sm bg-blue-50 text-blue-700 font-semibold px-3 py-2 rounded cursor-default">
      Inquiries
</div>

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
  <main class="flex-1 p-6 overflow-auto max-w-4xl mx-auto w-full">

    <!-- Heading outside white box -->
    <h2 class="text-3xl font-bold text-gray-800 mb-6">
      Customer Inquiries
    </h2>

    <!-- Messages container WITHOUT white background -->
    <div>

      @if($messages->isEmpty())
        <div class="text-gray-500">No contact messages available.</div>
      @else
        <ul>
          @foreach ($messages as $msg)
            <li class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4 relative flex justify-between items-start min-h-[80px]">
              <div class="w-full pr-20">
                <div class="flex justify-between">
                  <h3 class="text-lg font-semibold text-gray-800">{{ $msg->name }}</h3>
                  <span class="text-sm text-gray-500">{{ $msg->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs text-gray-400">{{ $msg->email }}</p>
                <p class="mt-1 text-gray-700 whitespace-normal break-words">{{ $msg->message }}</p>
              </div>

              <div class="absolute bottom-3 right-4 text-gray-500 text-sm italic">
               @if(!$msg->is_read)
     <form method="POST" action="{{ route('contact.markAsRead', $msg->id) }}">
        @csrf
        <button type="submit" class="text-indigo-600 hover:underline font-semibold">
            Mark as Read
        </button>
    </form>
  @else
                  <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                    Read
                  </span>
                @endif
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>

  </main>
</div>

</body>
</html>
