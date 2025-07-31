<!DOCTYPE html>
<html lang="en" class="bg-gradient-to-br from-indigo-100 via-white to-indigo-100">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>House Owner Login - Rentalz</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="font-sans flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

    <div class="mb-8 text-center">
      <div class="inline-block bg-indigo-600 rounded-full p-4 mb-4">
        <svg class="w-8 h-8 text-white mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2z" />
          <path d="M17 21v-2a4 4 0 00-8 0v2" />
          <path d="M6 8v-2a4 4 0 018 0v2" />
        </svg>
      </div>
      <h2 class="text-3xl font-bold text-indigo-700">House Owner Login</h2>
      <p class="mt-1 text-gray-600 text-sm">Welcome back! Please login to continue.</p>
    </div>

    @if(session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center font-medium">
        {{ session('error') }}
      </div>
    @endif
<form method="POST" action="{{ route('houseowner.login.submit') }}">
      @csrf

      <!-- Email Field -->
      <div class="mb-6">
        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="rahul@example.com"
          required
          autofocus
          class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
        >
      </div>

      <!-- Password Field -->
      <div class="mb-8">
        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="••••••••"
          required
          class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
        >
      </div>

      <!-- Submit Button -->
      <button
        type="submit"
        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-md transition"
      >
        Log In
      </button>
    </form>

    <p class="mt-6 text-center text-gray-700 text-sm">
      Don't have an account?
     <a href="{{ route('houseowners.register.form') }}" class="text-indigo-600 hover:underline font-semibold">
        Register here
      </a>
    </p>

  </div>

</body>
</html>
