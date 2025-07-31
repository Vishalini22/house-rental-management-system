<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Property Details - Rentalz Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 flex min-h-screen">
  

 <!-- Sidebar Navigation -->
<aside class="w-64 bg-white p-6 shadow-lg border border-gray-200 min-h-screen hidden md:block" x-data="{ openMenus: {} }">
  <h1 class="text-2xl font-bold text-indigo-600 mb-10">Rentalz Admin</h1>
  <nav class="space-y-2">

    <div class="block text-sm bg-blue-50 text-blue-700 font-semibold px-3 py-2 rounded cursor-default">
      Dashboard
</div>
    

    <!-- Properties Dropdown -->
    <div>
      <button
        @click="openMenus.properties = !openMenus.properties"
        class="w-full flex justify-between items-center text-gray-800 hover:text-indigo-600 font-medium px-3 py-2 rounded focus:outline-none"
      >
        <span>Properties</span>
        <svg :class="{ 'transform rotate-180': openMenus.properties }"
             class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 9l6 6 6-6" />
        </svg>
      </button>
      <div x-show="openMenus.properties" x-transition class="mt-1 pl-4 space-y-1">
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
      >
        <span>Customers</span>
        <svg :class="{ 'transform rotate-180': openMenus.customers }"
             class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 9l6 6 6-6" />
        </svg>
      </button>
      <div x-show="openMenus.customers" x-transition class="mt-1 pl-4 space-y-1">
        <a href="/admin/customers/active"
           class="block text-sm text-gray-600 hover:text-indigo-600 font-medium px-3 py-1.5">
          Active
        </a>
        <a href="/admin/pending-customers"
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
      >
        <span>House Owners</span>
        <svg :class="{ 'transform rotate-180': openMenus.owners }"
             class="w-4 h-4 transition-transform" fill="none"
             stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 9l6 6 6-6" />
        </svg>
      </button>
      <div x-show="openMenus.owners" x-transition class="mt-1 pl-4 space-y-1">
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
       class="block px-3 py-2 rounded font-medium transition
       {{ request()->routeIs('admin.bookings') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-800 hover:text-indigo-600' }}">
      Booking Requests
    </a>

    <!-- Inquiries -->
    <a href="{{ route('admin.contact.messages') }}"
       class="block px-3 py-2 rounded font-medium transition
       {{ request()->routeIs('admin.contact.messages') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-800 hover:text-indigo-600' }}">
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



  <!-- Main Content Area -->
  <main class="flex-1 p-6 bg-gray-100">



    <!-- Page Heading -->
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Property Details</h2>

    <!-- Property Summary Section -->
    <div
      class="bg-pink-50 rounded-xl shadow-md px-6 py-12 mb-10 max-w-3xl mx-auto flex flex-col md:flex-row items-center md:items-start justify-between gap-6">

      <!-- Pie Chart Left -->
      <div class="w-28 flex-shrink-0">
        <canvas id="propertySummaryChart" style="width: 100px; height: 100px;"></canvas>
      </div>

      <!-- Center: Property Counts -->
      <div class="flex-1">
        <p class="text-sm text-gray-600 mb-1">Total Properties</p>
        <h1 class="text-5xl font-extrabold text-gray-900">{{ $totalProperties }}</h1>
        <p class="text-sm text-gray-500 mt-2">Updated {{ now()->diffForHumans($lastPropertyUpdate) }}</p>
      </div>

      <!-- Color Legend -->
      <div class="flex flex-col items-start">
        <div class="w-36 text-sm text-gray-700 space-y-4">
          <div class="flex items-center gap-2">
            <div class="w-4 h-4 rounded-full" style="background-color: #60a5fa;"></div>
            <span><strong>{{ $pendingProperties }}</strong> Pending</span>
          </div>
          <div class="flex items-center gap-2">
            <div class="w-4 h-4 rounded-full" style="background-color: #34d399;"></div>
            <span><strong>{{ $approvedProperties }}</strong> Approved</span>
          </div>
          <div class="flex items-center gap-2">
            <div class="w-4 h-4 rounded-full" style="background-color: #fb7185;"></div>
            <span><strong>{{ $rejectedProperties ?? 0 }}</strong> Rejected</span>
          </div>
        </div>
      </div>

      <!-- SVG House Illustration -->
      <div class="flex justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-pink-400" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 10l9-7 9 7v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V9h6v12" />
        </svg>
      </div>
    </div>

    <!-- 4 Summary Cards Below Property Summary with Heroicons SVG -->
    <div class="max-w-7xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

      <!-- Pending Customers -->
      <div
        class="bg-white shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300 flex flex-col justify-center items-center text-center">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center justify-center gap-2 whitespace-nowrap">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A9 9 0 1118.88 6.196 9 9 0 015.12 17.804z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Pending Customers
        </h3>
        <div class="text-5xl font-extrabold text-gray-900">{{ $pendingCustomers }}</div>
        <p class="text-sm text-gray-500 mt-2">Awaiting admin approval</p>
      </div>

      <!-- Pending House Owners -->
      <div
        class="bg-white shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300 flex flex-col justify-center items-center text-center">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center justify-center gap-2 whitespace-nowrap">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 12l9-9 9 9v9a3 3 0 01-3 3H6a3 3 0 01-3-3v-9z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 21v-6h6v6" />
          </svg>
          Pending House Owners
        </h3>
        <div class="text-5xl font-extrabold text-gray-900">{{ $pendingHouseOwners }}</div>
        <p class="text-sm text-gray-500 mt-2">New owners awaiting approval</p>
      </div>

      <!-- Bookings Sent -->
      <div
        class="bg-white shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300 flex flex-col justify-center items-center text-center">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center justify-center gap-2 whitespace-nowrap">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M10.5 19.5l10.5-7.5-10.5-7.5v5.25l-7.5 2.25 7.5 2.25v5.25z" />
          </svg>
          Bookings Sent
        </h3>
        <div class="text-5xl font-extrabold text-gray-900">{{ $inquiriesSent }}</div>
        <p class="text-sm text-gray-500 mt-2">Booking details sent</p>
      </div>

      <!-- Bookings Pending -->
      <div
        class="bg-white shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300 flex flex-col justify-center items-center text-center">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center justify-center gap-2 whitespace-nowrap">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
          Bookings Pending
        </h3>
        <div class="text-5xl font-extrabold text-gray-900">{{ $inquiriesPending }}</div>
        <p class="text-sm text-gray-500 mt-2">Pending to forward</p>
      </div>
    </div>

    <!-- Latest Live Properties and Customer Inquiries Side by Side -->
    <div class="mt-12 max-w-7xl mx-auto grid grid-cols-1 xl:grid-cols-3 gap-8">

      <!-- Live Properties - take 2/3 width (2 columns) -->
      <div class="xl:col-span-2" x-data="{
          current: 0,
          properties: {{ Js::from($latestProperties) }},
          next() {
              if (this.current < this.properties.length - 1) this.current++
          },
          prev() {
              if (this.current > 0) this.current--
          }
      }">

        <!-- No heading here as requested -->

        <!-- Card -->
        <template x-if="properties.length">
          <div class="bg-white border border-gray-200 shadow rounded-xl overflow-hidden transition-all duration-500">

            <!-- Image -->
            <div>
             <a :href="`/admin/approved-property/${properties[current].id}`">
  <img :src="properties[current].main_image ?? '/images/default.jpg'"
       alt="Property Image"
       class="w-full h-96 object-cover rounded-t-xl">
</a>
            </div>

            <!-- Property Info -->
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-800 mb-1" x-text="properties[current].title"></h3>
             <p class="text-sm text-gray-600 mb-2">
  <strong>Location:</strong> <span x-text="properties[current].address"></span>
</p>

              <p class="text-sm text-gray-700 mt-2" x-text="properties[current].description ?? 'No description available.'"></p>

              <!-- Navigation arrows below description -->
              <div class="mt-6 flex justify-center gap-6 text-gray-600 text-3xl select-none">
                <!-- Left arrow -->
                <span 
                  @click="prev" 
                  :class="{ 'cursor-not-allowed opacity-40': current === 0, 'cursor-pointer hover:text-indigo-600': current > 0 }"
                  role="button"
                  aria-label="Previous property"
                >
                  &#8592;
                </span>

                <!-- Right arrow -->
                <span 
                  @click="next" 
                  :class="{ 'cursor-not-allowed opacity-40': current === properties.length - 1, 'cursor-pointer hover:text-indigo-600': current < properties.length - 1 }"
                  role="button"
                  aria-label="Next property"
                >
                  &#8594;
                </span>
              </div>
            </div>
          </div>
        </template>
      </div>

      <!-- Recent Customer Inquiries - take 1/3 width (1 column) -->
      <div>
        <ul class="bg-white divide-y divide-gray-100 border border-gray-200 rounded-lg shadow max-h-[600px] overflow-y-auto">
          <!-- Title inside white box -->
          <li class="p-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Recent Customer Inquiries</h2>
          </li>
          @forelse ($recentMessages as $msg)
            <li class="p-4 hover:bg-gray-50 cursor-pointer">
              <div class="flex justify-between">
                <span class="font-semibold text-gray-800">{{ $msg->name }}</span>
                <span class="text-sm text-gray-500">{{ $msg->created_at->diffForHumans() }}</span>
              </div>
              <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $msg->message }}</p>
            </li>
          @empty
            <li class="p-4 text-sm text-gray-500">No inquiries found.</li>
          @endforelse
        </ul>
      </div>

    </div>

  </main>

  <script>
    window.addEventListener('DOMContentLoaded', function () {
      const pendingProperties = {{ $pendingProperties }};
      const approvedProperties = {{ $approvedProperties }};
      const rejectedProperties = {{ $rejectedProperties ?? 0 }};

      const summaryCtx = document.getElementById('propertySummaryChart').getContext('2d');
      new Chart(summaryCtx, {
        type: 'doughnut',
        data: {
          labels: ['Pending', 'Approved', 'Rejected'],
          datasets: [{
            data: [pendingProperties, approvedProperties, rejectedProperties],
            backgroundColor: ['#60a5fa', '#34d399', '#fb7185'],
            borderWidth: 0
          }]
        },
        options: {
          cutout: '60%',
          plugins: {
            legend: { display: false }
          }
        }
      });
    });
  </script>

</body>

</html>
