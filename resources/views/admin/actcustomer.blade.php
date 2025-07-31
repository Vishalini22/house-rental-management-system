<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rentalz Admin - Active Customers</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .customer-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      margin-bottom: 1.5rem;
    }
    .customer-card:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
      transform: translateY(-2px);
    }

    @media (min-width: 768px) {
      .customer-card {
        flex-direction: row;
        align-items: flex-start;
        justify-content: space-between;
      }
    }

    .customer-info {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      min-width: 220px;
    }

    .customer-info img {
      width: 56px;
      height: 56px;
      border-radius: 9999px;
      border: 2px solid #C01234;
      object-fit: cover;
      object-position: top center;
    }

    .customer-name {
      font-weight: 600;
      font-size: 1.125rem;
      color: #1e293b;
    }

    .customer-joined {
      font-size: 0.8rem;
      color: #6b7280;
      white-space: pre-line;
      line-height: 1.3;
    }

    .details-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      max-width: 700px;
      width: 100%;
      word-break: break-word;
    }

    .detail-item {
      display: flex;
      flex-direction: column;
    }

    .detail-label {
      font-weight: 600;
      color: #374151;
      font-size: 0.85rem;
      margin-bottom: 0.25rem;
    }

    .detail-value {
      font-size: 0.9rem;
      color: #4b5563;
      word-break: break-word;
      overflow-wrap: break-word;
    }
  </style>
</head>
<body>
<div class="flex min-h-screen">
  <aside class="w-64 bg-white p-6 shadow-lg border border-gray-200 min-h-screen hidden md:block"
         x-data="{ openMenus: { properties: false, customers: true, owners: false } }">
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
          <svg :class="{'transform rotate-180': openMenus.properties}" class="w-4 h-4 transition-transform" fill="none"
               stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div x-show="openMenus.properties" x-transition class="mt-1 pl-4 space-y-1">
          <a href="{{ route('admin.all-properties') }}"
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5 {{ request()->routeIs('admin.all-properties') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Approved Properties
          </a>
          <a href="{{ route('admin.pending') }}"
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5 {{ request()->routeIs('admin.pending') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Pending Properties
          </a>
        </div>
      </div>

      <div>
        <button @click="openMenus.customers = !openMenus.customers"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none">
          <span>Customers</span>
          <svg :class="{'transform rotate-180': openMenus.customers}" class="w-4 h-4 transition-transform" fill="none"
               stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div x-show="openMenus.customers" x-transition class="mt-1 pl-4 space-y-1">
          <div class="block text-sm text-gray-400 font-medium px-3 py-1.5 rounded cursor-default select-none"
               aria-disabled="true">
            Active
          </div>
          <a href="{{ route('admin.customers.pending') }}"
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5 {{ request()->routeIs('admin.customers.pending') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Pending
          </a>
        </div>
      </div>

      <div>
        <button @click="openMenus.owners = !openMenus.owners"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none">
          <span>House Owners</span>
          <svg :class="{'transform rotate-180': openMenus.owners}" class="w-4 h-4 transition-transform" fill="none"
               stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div x-show="openMenus.owners" x-transition class="mt-1 pl-4 space-y-1">
          <a href="{{ route('houseowners.approved') }}"
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5 {{ request()->routeIs('houseowners.approved') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Approved
          </a>
          <a href="{{ route('houseowners.pending') }}"
             class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5 {{ request()->routeIs('houseowners.pending') ? 'bg-blue-50 text-blue-700 font-semibold rounded' : '' }}">
            Pending
          </a>
        </div>
      </div>

      <a href="{{ route('admin.bookings') }}"
         class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded {{ request()->routeIs('admin.bookings') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
        Booking Requests
      </a>

      <a href="{{ route('admin.contact.messages') }}"
         class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded {{ request()->routeIs('admin.contact.messages') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
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
      <h2 class="text-3xl font-bold text-gray-800">Active Customers</h2>
    </div>

    <!-- Customer Cards -->
    <section>
      @forelse ($activeCustomers as $customer)
        <div class="customer-card">
          <div class="customer-info">
            @if($customer->profile_photo && file_exists(storage_path('app/public/' . $customer->profile_photo)))
              <img src="{{ asset('storage/' . $customer->profile_photo) }}" alt="Profile" />
            @else
              <div class="w-14 h-14 rounded-full bg-indigo-500 text-white flex items-center justify-center text-lg font-bold border-2 border-indigo-500">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
              </div>
            @endif
            <div class="mt-1">
              <h3 class="customer-name">{{ $customer->name }}</h3>
              <p class="customer-joined">Joined on {{ \Carbon\Carbon::parse($customer->created_at)->format('F d, Y') }}</p>
            </div>
          </div>

          <div class="details-grid">
            <div class="detail-item">
              <span class="detail-label">Email</span>
              <span class="detail-value">{{ $customer->email }}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Phone</span>
              <span class="detail-value">{{ $customer->phone }}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Location</span>
              <span class="detail-value">{{ $customer->preferred_location ?? 'N/A' }}</span>
            </div>
          </div>
        </div>
      @empty
        <p class="text-gray-600">No active customers found.</p>
      @endforelse
    </section>
  </main>
</div>
</body>
</html>
