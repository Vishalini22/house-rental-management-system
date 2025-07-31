<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pending Customers - Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .customer-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
      padding: 1.5rem;
      display: grid;
      grid-template-columns: 1.5fr 3fr auto;
      align-items: start; /* Align all columns to the top */
      gap: 1.5rem;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      margin-bottom: 1.5rem;
    }

    .customer-card:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
      transform: translateY(-2px);
    }

    .customer-info {
      display: flex;
      align-items: center;
      gap: 1rem;
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
      white-space: normal;
      text-transform: capitalize;
    }

    @media (max-width: 768px) {
      .customer-card {
        grid-template-columns: 1fr;
      }

      .action-buttons {
        justify-self: start;
      }
    }
  </style>
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
  <!-- Sidebar -->
  <aside class="w-64 bg-white p-6 shadow-lg border-r border-gray-200 min-h-screen hidden md:block" x-data="{ openMenus: { customers: true } }">
    <h1 class="text-2xl font-bold text-indigo-600 mb-10">Rentalz Admin</h1>
    <nav class="space-y-2">
      <a href="#" class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">Dashboard</a>

      <div>
        <button @click="openMenus.properties = !openMenus.properties"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">
          <span>Properties</span>
          <svg :class="{'transform rotate-180': openMenus.properties}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div x-show="openMenus.properties" class="mt-1 pl-4 space-y-1">
          <a href="{{ route('admin.all-properties') }}" class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">Approved Properties</a>
          <a href="{{ route('admin.pending') }}" class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">Pending Properties</a>
        </div>
      </div>

      <div>
        <button @click="openMenus.customers = !openMenus.customers"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">
          <span>Customers</span>
          <svg :class="{'transform rotate-180': openMenus.customers}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div x-show="openMenus.customers" class="mt-1 pl-4 space-y-1">
          <a href="/admin/customers/active" class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">Active</a>
          <div class="block text-sm text-gray-400 font-medium px-3 py-1.5 cursor-default bg-gray-100 rounded">Pending</div>
        </div>
      </div>

      <div>
        <button @click="openMenus.owners = !openMenus.owners"
                class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">
          <span>House Owners</span>
          <svg :class="{'transform rotate-180': openMenus.owners}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div x-show="openMenus.owners" class="mt-1 pl-4 space-y-1">
          <a href="{{ route('houseowners.approved') }}" class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">Approved</a>
          <a href="{{ route('houseowners.pending') }}" class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">Pending</a>
        </div>
      </div>

      <a href="{{ route('admin.bookings') }}" class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">Booking Requests</a>
      <a href="{{ route('admin.contact.messages') }}" class="block text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded">Inquiries</a>

      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="block w-full text-left px-3 py-2 rounded font-medium text-gray-800 hover:text-red-600 transition-colors">Logout</button>
      </form>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6 bg-gray-50 overflow-y-auto">
    <div class="mb-6">
      <h2 class="text-3xl font-bold text-gray-800">Pending Customers</h2>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-6">
        {{ session('success') }}
      </div>
    @endif

    <section>
      @forelse ($pendingCustomers as $customer)
        <div class="customer-card">
          <!-- Profile and Name -->
          <div class="customer-info">
            @if($customer->profile_photo && file_exists(storage_path('app/public/' . $customer->profile_photo)))
              <img src="{{ asset('storage/' . $customer->profile_photo) }}" alt="Profile">
            @else
              <div class="w-14 h-14 rounded-full bg-indigo-500 text-white flex items-center justify-center text-lg font-bold border-2 border-indigo-500">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
              </div>
            @endif
            <div>
              <h3 class="customer-name">{{ $customer->name }}</h3>
              <p class="customer-joined">Joined on {{ \Carbon\Carbon::parse($customer->created_at)->format('F d, Y') }}</p>
            </div>
          </div>

          <!-- Details -->
          <div class="grid grid-cols-3 gap-4">
            <div>
              <p class="detail-label">Email</p>
              <p class="detail-value">{{ $customer->email }}</p>
            </div>
            <div>
              <p class="detail-label">Phone</p>
              <p class="detail-value">{{ $customer->phone ?? 'N/A' }}</p>
            </div>
            <div>
              <p class="detail-label">Location</p>
              <p class="detail-value">{{ $customer->preferred_location ?? 'Unknown' }}</p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="action-buttons flex flex-row space-x-2">
            <form action="{{ route('pencustomer.accept', $customer->id) }}" method="POST">
              @csrf
              <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">Accept</button>
            </form>
            <form action="{{ route('pencustomer.delete', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">Delete</button>
            </form>
          </div>
        </div>
      @empty
        <p class="text-gray-600">No pending customers available.</p>
      @endforelse
    </section>
  </main>
</div>
</body>
</html>
