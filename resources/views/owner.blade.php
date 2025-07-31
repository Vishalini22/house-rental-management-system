@php
  use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>List Your Property - Rentalz</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">


  <div class="max-w-4xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-indigo-600 mb-6 text-center">
      🏠 List Your Property for Rent
    </h2>
@if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
    {{ session('success') }}
  </div>
@endif


  <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
  @csrf

  <!-- Grid layout for property + owner -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Left Column: Property Details -->
    <div>
      <!-- Property Title -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Property Title</label>
        <input type="text" name="title" placeholder="e.g., 2 BHK Apartment in Downtown"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Address -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
        <input type="text" name="address" placeholder="Full address with city & ZIP"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <!-- Rent -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Monthly Rent (₹)</label>
        <input type="number" name="price" placeholder="e.g., 12000"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Features -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Bedrooms</label>
          <input type="number" name="bedrooms" placeholder="e.g., 2" class="w-full border rounded-md px-4 py-2" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Bathrooms</label>
          <input type="number" name="bathrooms" placeholder="e.g., 1" class="w-full border rounded-md px-4 py-2" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Area (sq.ft)</label>
          <input type="number" name="sqft" placeholder="e.g., 850" class="w-full border rounded-md px-4 py-2" required>
        </div>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="4" placeholder="Give a detailed description of your property..."
                  class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
      </div>

      <!-- Property Image Upload -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Property Image</label>
        <input type="file" name="images[]" accept="image/*" multiple

               class="w-full border rounded-md px-4 py-2 bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-indigo-600 file:text-white hover:file:bg-indigo-700"/>
      </div>
    </div>

    <!-- Right Column: Owner Details -->
    <div>
      <!-- Owner Name -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Owner Full Name</label>
        <input type="text" name="owner_name" placeholder="e.g., Rajesh Kumar"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Owner Contact -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number / Email</label>
        <input type="text" name="owner_contact" placeholder="e.g., 0765764310 or email@example.com"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Owner Photo Upload -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Your Photo</label>
        <input type="file" name="owner_photo" accept="image/*"
               class="w-full border rounded-md px-4 py-2 bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-indigo-600 file:text-white hover:file:bg-indigo-700"/>
    
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="text-center">
    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
      Submit Property
    </button>
  </div>
</form>

  </div>
</body>
</html>
