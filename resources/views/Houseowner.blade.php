<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>House Owner Sign Up - Rentalz</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans">
  <div class="max-w-2xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-indigo-600 mb-6 text-center">
      🏠 House Owner Sign Up
    </h2>

    @if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-700 font-semibold">
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="mb-4 p-3 rounded bg-red-100 text-red-700">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

   <form action="{{ route('houseowners.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Full Name -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
        <input type="text" name="name" placeholder="e.g., Rahul Mehta"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" placeholder="e.g., rahul@example.com"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Phone Number -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
        <input type="text" name="phone" placeholder="e.g., 9876543210"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Business Details (Optional) -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Business Details (Optional)</label>
        <textarea name="business_details" placeholder="E.g., Rental agency, Property management details"
                  class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none" rows="3"></textarea>
      </div>

      <!-- Address -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
        <textarea name="address" placeholder="Full address"
                  class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none" rows="3" required></textarea>
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" placeholder="Choose a secure password"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Confirm Password -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Repeat your password"
               class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- ID Proof Upload -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Upload ID Proof</label>
        <input type="file" name="id_proof" accept="image/*,application/pdf"
               class="w-full border rounded-md px-4 py-2 bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-indigo-600 file:text-white hover:file:bg-indigo-700" required />
        <p class="text-sm text-gray-500 mt-1">Upload government issued ID proof (image or PDF)</p>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
          Register as House Owner
        </button>
      </div>
    </form>

    <!-- Added Login Link Below Submit Button -->
    <p class="mt-4 text-center text-gray-600 text-sm">
      Already have an account? 
      <a href="{{ route('owners.login') }}" class="text-indigo-600 hover:underline font-semibold">
       Sign in here
      </a>
    </p>

  </div>
</body>
</html>
