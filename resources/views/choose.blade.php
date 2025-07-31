<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Choose Your Role - Rentalz</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-10 rounded-xl shadow-xl w-full max-w-3xl">
      <h2 class="text-3xl font-bold text-center text-indigo-600 mb-10">
        Welcome! What would you like to do on Rentalz?
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- I'm a Customer -->
        <div class="bg-blue-50 p-6 rounded-lg hover:shadow-lg transition-all duration-300 text-center">
          <div class="text-4xl mb-2">🧍‍♂️</div>
          <h3 class="text-xl font-semibold mb-2">I'm looking for a house</h3>
          <p class="text-gray-600 mb-4">Browse and contact property owners</p>
          <a href="{{ route('renter') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            I'm a Customer
          </a>
        </div>

        <!-- I'm a House Owner -->
        <div class="bg-green-50 p-6 rounded-lg hover:shadow-lg transition-all duration-300 text-center">
          <div class="text-4xl mb-2">🏠</div>
          <h3 class="text-xl font-semibold mb-2">I want to list my house</h3>
          <p class="text-gray-600 mb-4">Submit property details for rent</p>
          <a href="{{ route('houseowners.register.form') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            I'm a House Owner
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
