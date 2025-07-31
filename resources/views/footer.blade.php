<footer class="bg-gray-800 text-gray-300 pt-16 pb-14 px-6 md:px-20 animate-on-scroll">
  <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12 text-lg md:text-base">
    
    <!-- Logo & About Section in Footer -->
    <div class="space-y-6 flex flex-col items-start">
      <div class="flex items-center space-x-3 mb-3">
        <!-- White house SVG icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 24 24" stroke="none">
          <path d="M3 11L12 2l9 9v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-9z"/>
        </svg>
        <span class="text-white text-3xl font-bold tracking-wide">Rentalz</span>
      </div>
      <div style="height: 48px;"></div>
    </div>

    <!-- Pages -->
    <div class="ml-24">
      <h4 class="text-white font-bold mb-6 text-2xl md:text-xl tracking-wide">Pages</h4>
      <ul class="space-y-4 max-w-xs">
        <li><a href="{{ route('home') }}" class="hover:text-red-500 transition text-lg md:text-base">Home</a></li>
        <li><a href="{{ route('listings') }}" class="hover:text-red-500 transition text-lg md:text-base">Listings</a></li>
        <li><a href="{{ route('about') }}" class="hover:text-red-500 transition text-lg md:text-base">About Us</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-red-500 transition text-lg md:text-base">Contact</a></li>
      </ul>
    </div>

    <!-- For Owners -->
    <div class="ml-12">
      <h4 class="text-white font-bold mb-6 text-2xl md:text-xl tracking-wide"> Owners</h4>
      <ul class="space-y-4 max-w-xs">
        <li><a href="{{ url('/owner') }}" class="hover:text-red-500 transition text-lg md:text-base">List Your Property</a></li>
        <li><a href="{{ route('houseowners.register.form') }}" class="hover:text-red-500 transition text-lg md:text-base">Register as Owner</a></li>
        <li><a href="{{ route('owners.login') }}" class="hover:text-red-500 transition text-lg md:text-base">Owner Login</a></li>
      </ul>
    </div>

    <!-- For Renters -->
    <div>
      <h4 class="text-white font-bold mb-6 text-2xl md:text-xl tracking-wide">Renters</h4>
      <ul class="space-y-4 max-w-xs">
        <li><a href="{{ route('customer.register.form') }}" class="hover:text-red-500 transition text-lg md:text-base">Sign Up</a></li>
        <li><a href="{{ route('customer.login') }}" class="hover:text-red-500 transition text-lg md:text-base">Login</a></li>
        <li><a href="{{ route('listings') }}" class="hover:text-red-500 transition text-lg md:text-base">Browse Rentals</a></li>
      </ul>
    </div>
  </div>

  <div class="mt-14 text-center text-gray-400 text-sm md:text-base tracking-wider">
    © {{ date('Y') }} Rentalz. All rights reserved.
  </div>
</footer>
