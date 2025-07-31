<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rentalz Admin - House Owners</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

  <div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md p-6">
      <h1 class="text-2xl font-bold mb-12 text-indigo-600">Rentalz</h1>
      <nav class="space-y-6 text-slate-700">
        <a href="#" class="flex items-center hover:text-indigo-600">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8" />
          </svg>
          Dashboard
        </a>
        <a href="#" class="flex items-center hover:text-indigo-600">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M4 6h16M4 12h8m-8 6h16" />
          </svg>
          Properties
        </a>
        <a href="#" class="flex items-center hover:text-indigo-600">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7" />
          </svg>
          Customers
        </a>
        <a href="#" class="flex items-center font-semibold text-indigo-600">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
          </svg>
          House Owners
        </a>
        <a href="#" class="flex items-center text-gray-700 hover:text-indigo-500">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M3 4a2 2 0 012-2h14a2 2 0 012 2v16l-8-4-8 4V4z"/>
          </svg>
          Reviews
        </a>
      
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
      <div class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-slate-800">All House Owners</h2>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
          + Add Owner
        </button>
      </div>

      <!-- Owner Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Owner Card -->
        <div class="bg-white rounded-xl shadow-md p-5 flex flex-col gap-4 hover:shadow-lg transition">
          <div class="flex items-center gap-4">
            <img src="https://randomuser.me/api/portraits/men/40.jpg" class="w-14 h-14 rounded-full border-2 border-indigo-600" />
            <div>
              <h3 class="font-semibold text-lg text-slate-800">John Doe</h3>
              <p class="text-sm text-slate-500">john@example.com</p>
              <p class="text-xs text-slate-400 mt-1">Joined on 12/02/2022</p>
            </div>
          </div>
          <div class="flex justify-between text-sm text-slate-600">
            <p><span class="font-medium">Location:</span> New York</p>
            <p><span class="font-medium">Properties:</span> 8</p>
          </div>
          <div class="flex gap-2 mt-3">
            <button class="bg-gray-600 text-white px-3 py-1 rounded-md hover:bg-gray-700 text-sm">View</button>
            <button class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-md hover:bg-yellow-500 text-sm">Suspend</button>
            <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 text-sm">Delete</button>
          </div>
        </div>

        <!-- Owner Card (example 2) -->
        <div class="bg-white rounded-xl shadow-md p-5 flex flex-col gap-4 hover:shadow-lg transition">
          <div class="flex items-center gap-4">
            <img src="https://randomuser.me/api/portraits/women/65.jpg" class="w-14 h-14 rounded-full border-2 border-indigo-600" />
            <div>
              <h3 class="font-semibold text-lg text-slate-800">Linda Smith</h3>
              <p class="text-sm text-slate-500">linda@example.com</p>
              <p class="text-xs text-slate-400 mt-1">Joined on 08/06/2021</p>
            </div>
          </div>
          <div class="flex justify-between text-sm text-slate-600">
            <p><span class="font-medium">Location:</span> California</p>
            <p><span class="font-medium">Properties:</span> 12</p>
          </div>
          <div class="flex gap-2 mt-3">
            <button class="bg-gray-600 text-white px-3 py-1 rounded-md hover:bg-gray-700 text-sm">View</button>
            <button class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-md hover:bg-yellow-500 text-sm">Suspend</button>
            <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 text-sm">Delete</button>
          </div>
        </div>

        <!-- Add more owner cards as needed -->

      </div>
    </main>
  </div>

</body>
</html>
