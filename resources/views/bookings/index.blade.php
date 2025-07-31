


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>All Property Bookings - Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="//unpkg.com/alpinejs" defer></script>
  <style>
    body, html {
      overflow-x: hidden;
    }
    td, th {
      word-break: normal;
      white-space: normal;
      overflow-wrap: break-word;
      max-width: 200px;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

  <div class="flex min-h-screen">

    <aside
      class="w-64 bg-white p-6 shadow-lg border border-gray-200 min-h-screen hidden md:flex flex-col"
      x-data="{ openMenus: { properties: false, customers: false, owners: false } }"
      style="height: 100vh;"
    >
      <h1 class="text-2xl font-bold text-indigo-600 mb-10">Rentalz Admin</h1>

      <nav class="space-y-2 flex-1 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}"
           class="block px-3 py-2 rounded font-medium transition
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-800 hover:text-indigo-600' }}">
          Dashboard
        </a>

        <div>
          <button
            @click="openMenus.properties = !openMenus.properties"
            class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
            type="button"
          >
            <span>Properties</span>
            <svg :class="{'transform rotate-180': openMenus.properties}" class="w-4 h-4 transition-transform"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 9l6 6 6-6"/>
            </svg>
          </button>
          <div x-show="openMenus.properties" x-transition class="mt-1 pl-4 space-y-1">
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
          <button
            @click="openMenus.customers = !openMenus.customers"
            class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
            type="button"
          >
            <span>Customers</span>
            <svg :class="{'transform rotate-180': openMenus.customers}" class="w-4 h-4 transition-transform"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 9l6 6 6-6"/>
            </svg>
          </button>
          <div x-show="openMenus.customers" x-transition class="mt-1 pl-4 space-y-1">
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
          <button
            @click="openMenus.owners = !openMenus.owners"
            class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
            type="button"
          >
            <span>House Owners</span>
            <svg :class="{'transform rotate-180': openMenus.owners}" class="w-4 h-4 transition-transform"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 9l6 6 6-6"/>
            </svg>
          </button>
          <div x-show="openMenus.owners" x-transition class="mt-1 pl-4 space-y-1">
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

        <div class="block text-sm bg-blue-50 text-blue-700 font-semibold px-3 py-2 rounded cursor-default">
          Booking Requests
        </div>

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

    <main class="flex-1 p-6 bg-gray-50">
      <h1 class="text-4xl font-extrabold mb-12 text-center text-gray-900 tracking-wide">
        All Property Bookings
      </h1>

      @if ($bookings->isEmpty())
        <p class="text-center text-gray-400 text-xl italic">
          No bookings available.
        </p>
      @else
        <div class="overflow-x-auto shadow-md rounded-lg bg-white">
          <table class="min-w-full text-sm border table-auto">
            <thead class="bg-gray-100">
              <tr>
                <th class="p-3 text-left">Property</th>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Move-in Date</th>
                <th class="p-3 text-left">Duration</th>
                <th class="p-3 text-left">Submitted On</th>
                <th class="p-3 text-left">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bookings as $booking)
              <tr class="border-b hover:bg-indigo-50 transition">
                <td class="p-3 font-semibold text-gray-800">{{ $booking->property->title }}</td>
                <td class="p-3 text-gray-700">{{ $booking->customer->name }}</td>
                <td class="p-3 text-gray-700">{{ $booking->customer->email }}</td>
                <td class="p-3 text-gray-700">{{ \Carbon\Carbon::parse($booking->move_in_date)->format('F d, Y') }}</td>
                <td class="p-3 text-gray-700">{{ $booking->duration_months }} months</td>
                <td class="p-3 text-gray-500 text-sm">{{ $booking->created_at->format('M d, Y') }}</td>
                <td class="p-3">
                  @if(!$booking->sent_to_owner)
                    <form action="{{ route('admin.bookings.sendToOwner', $booking->id) }}" method="POST" class="inline">
                      @csrf
                      <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Send to Owner</button>
                    </form>
                  @else
                    <span class="text-green-600 font-semibold">✅ Sent</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </main>
  </div>

</body>
</html>
