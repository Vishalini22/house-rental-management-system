<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rentalz | House Rental Management</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://unpkg.com/heroicons@1.0.6/dist/outline/heroicons.js"></script>

  <style>
    h1, p {
      background: none;
      box-shadow: none;
      outline: none;
      border: none;
    }
    body {
      background-color: white;
      margin: 0;
      opacity: 0;
      transition: opacity 0.8s ease;
    }
    body.loaded {
      opacity: 1;
    }
    .hero-section {
      background-color: white;
      position: relative;
      overflow: hidden;
    }
    .hero-image {
      width: 100%;
      object-fit: cover;
      margin-top: -45px;
    }
    .hero-text {
      position: relative;
      z-index: 10;
      text-align: center;
      margin-top: 40px;
      margin-bottom: 4rem;
    }

    .icon-circle {
      background-color: #ef4444;
      color: white;
      border-radius: 9999px;
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.4), 0 4px 6px -2px rgba(239, 68, 68, 0.1);
      font-weight: bold;
      font-size: 1.25rem;
      flex-shrink: 0;
    }

    @keyframes fadeSlideUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fade-slide-up {
      animation: fadeSlideUp 0.8s ease forwards;
    }

    .property-card {
      transition: transform 0.3s ease;
    }
    .property-card:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
    }

    @keyframes pulseScale {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
    }
    .button-pulse:hover {
      animation: pulseScale 0.6s ease-in-out infinite;
    }

    .how-it-works .animate-item {
      opacity: 0;
      transform: translateY(20px);
      animation-fill-mode: forwards;
      animation-name: fadeSlideUp;
      animation-duration: 0.6s;
      animation-timing-function: ease;
    }
    .how-it-works .animate-item:nth-child(1) { animation-delay: 0.2s; }
    .how-it-works .animate-item:nth-child(2) { animation-delay: 0.4s; }
    .how-it-works .animate-item:nth-child(3) { animation-delay: 0.6s; }
    .how-it-works .animate-item:nth-child(4) { animation-delay: 0.8s; }
    .how-it-works .animate-item:nth-child(5) { animation-delay: 1s; }
    .how-it-works .animate-item:nth-child(6) { animation-delay: 1.2s; }
    .how-it-works .animate-item:nth-child(7) { animation-delay: 1.4s; }
    .how-it-works .animate-item:nth-child(8) { animation-delay: 1.6s; }

    .visible {
      opacity: 1 !important;
      transform: translateY(0) !important;
    }

    .animate-on-scroll {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Navigation Bar -->
  <nav class="bg-white shadow-sm py-4 px-10 flex justify-between items-center">
    <div class="text-2xl font-bold text-gray-800">Rentalz</div>
    <ul class="flex space-x-6 font-medium text-gray-700">
   <li>
  <span class="text-red-500 font-semibold cursor-default select-none">Home</span>
</li>

      <li><a href="{{ route('listings') }}" class="hover:text-red-500">Listings</a></li>
      <li><a href="{{ route('about') }}" class="hover:text-red-500">About Us</a></li>
      <li><a href="{{ route('contact') }}" class="hover:text-red-500">Contact</a></li>
    </ul>
    <div></div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section w-full mt-4">
    <div class="relative w-full overflow-hidden flex flex-col items-center">
      <div class="hero-text z-10 text-center mb-4 animate-fade-slide-up">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Find Your Perfect Rental Home</h1>
        <p class="text-lg text-gray-700">Browse verified listings and connect with property owners instantly.</p>
      </div>
      <img src="{{ asset('images/pppp.png') }}" alt="Rentalz Banner" class="hero-image">
    </div>
  </section>

  <!-- Get Started Section -->
  <section class="bg-gray-100 py-20 px-6 animate-on-scroll">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Join the Rentalz Community</h2>
      <p class="text-gray-600 mb-8 text-lg leading-relaxed">
        Whether you're searching for a place to live or listing your property for rent, Rentalz is your all-in-one platform. Get started now and enjoy a seamless rental experience.
      </p>
      <a href="{{ route('choose') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-4 rounded-lg text-lg shadow-lg transition-all duration-300 ease-in-out button-pulse">
        Get Started Now
      </a>
    </div>
  </section>

  <!-- Recent Listings -->
  <section class="recent-listings max-w-7xl mx-auto px-6 py-16 animate-on-scroll">
    <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Recent Listings</h2>

    @if(isset($recentListings) && $recentListings->isNotEmpty())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($recentListings->take(3) as $property)
          <a href="{{ route('listing.show', ['id' => $property['id']]) }}" 
             class="property-card bg-gray-50 rounded-xl overflow-hidden hover:shadow-xl transition duration-300 border border-gray-200">
            <img 
              src="{{ $property['main_image'] }}" 
              alt="{{ $property['title'] }}" 
              class="w-full h-64 object-cover"
              loading="lazy"
            />
            <div class="p-5 bg-white">
             <h3 class="text-xl font-semibold text-gray-900 mb-1 break-normal whitespace-normal" title="{{ $property['title'] }}">
  {{ $property['title'] }}
</h3>

              <p class="text-gray-600 text-sm mb-2 truncate" title="{{ $property['address'] }}">
                {{ $property['address'] }}
              </p>
              <p class="text-red-600 font-bold text-lg">₹{{ number_format($property['price']) }}/month</p>
            </div>
          </a>
        @endforeach
      </div>

      <!-- See All Listings Button -->
      <div class="text-center mt-10">
        <a href="{{ route('listings') }}"
           class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
          See All Listings
        </a>
      </div>
    @else
      <p class="text-center text-gray-600 mt-6">No recent listings found.</p>
    @endif
  </section>

  <!-- Services -->
  <section class="py-20 px-6 md:px-16 bg-gray-100 animate-on-scroll">
    <div class="flex justify-center mb-4">
      <img src="{{ asset('images/image.png') }}" alt="Tiny Icon" class="h-20 w-auto" />
    </div>

    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Services</h2>
    <p class="text-center max-w-3xl mx-auto mb-10 text-gray-700 text-base md:text-lg leading-relaxed">
      We offer a variety of verified rental houses to meet different needs and budgets.
    </p>

    <div class="max-w-7xl mx-auto grid gap-14 md:grid-cols-3">
      <div class="text-center hover:scale-105 transition-transform duration-300">
        <img src="{{ asset('images/eeee.jpg') }}" alt="Fully Furnished" class="mx-auto rounded-lg mb-5 shadow-md h-64 object-cover" />
        <h3 class="text-xl font-semibold mb-2">Fully Furnished</h3>
        <p class="text-gray-700 text-base max-w-xs mx-auto">
          Our homes come equipped with essential furniture and appliances.
        </p>
      </div>
      <div class="text-center hover:scale-105 transition-transform duration-300">
        <img src="{{ asset('images/ggg.jpeg') }}" alt="Accessible Locations" class="mx-auto rounded-lg mb-5 shadow-md h-64 object-cover" />
        <h3 class="text-xl font-semibold mb-2">Accessible Locations</h3>
        <p class="text-gray-700 text-base max-w-xs mx-auto">
          All properties are in prime areas with easy access to amenities.
        </p>
      </div>
      <div class="text-center hover:scale-105 transition-transform duration-300">
        <img src="{{ asset('images/jjj.png') }}" alt="Competitive Prices" class="mx-auto rounded-lg mb-5 shadow-md h-64 object-cover" />
        <h3 class="text-xl font-semibold mb-2">Competitive Prices</h3>
        <p class="text-gray-700 text-base max-w-xs mx-auto">
          Transparent pricing with no hidden charges.
        </p>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section class="py-16 px-6 md:px-20 bg-gray-200 how-it-works animate-on-scroll">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">How It Works</h2>
    <p class="max-w-3xl mx-auto text-center mb-14 text-gray-700">
      A simple and secure process for both house owners and renters, managed by our admin team.
    </p>
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
      <div class="space-y-12">
        <div class="flex items-start space-x-6 animate-item">
          <div class="icon-circle">1</div>
          <div>
            <h3 class="text-xl font-semibold mb-2">List Your Property</h3>
            <p class="text-gray-600 text-sm">
              House owners can log in and submit their rental properties. Listings are reviewed by our admin before going live.
            </p>
          </div>
        </div>
        <div class="flex items-start space-x-6 animate-item">
          <div class="icon-circle">2</div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Explore Listings</h3>
            <p class="text-gray-600 text-sm">
              Approved properties are showcased to customers, who can browse, compare, and choose homes that match their needs.
            </p>
          </div>
        </div>
      </div>
      <div class="space-y-12">
        <div class="flex items-start space-x-6 animate-item">
          <div class="icon-circle">3</div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Send Inquiry</h3>
            <p class="text-gray-600 text-sm">
              Interested customers submit their details to the admin. Each inquiry is verified before being forwarded to the property owner.
            </p>
          </div>
        </div>
        <div class="flex items-start space-x-6 animate-item">
          <div class="icon-circle">4</div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Connect & Move In</h3>
            <p class="text-gray-600 text-sm">
              Owners receive vetted inquiries from the admin. After mutual agreement, customers complete the process and move in confidently.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Continue from previous content -->
<!-- Footer -->
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
      <h4 class="text-white font-bold mb-6 text-2xl md:text-xl tracking-wide">For Owners</h4>
      <ul class="space-y-4 max-w-xs">
        <li><a href="http://127.0.0.1:8000/owner" class="hover:text-red-500 transition text-lg md:text-base">List Your Property</a></li>
        <li><a href="{{ route('houseowners.register.form') }}" class="hover:text-red-500 transition text-lg md:text-base">Register as Owner</a></li>
        <li><a href="{{ route('owners.login') }}" class="hover:text-red-500 transition text-lg md:text-base">Owner Login</a></li>
      </ul>
    </div>

    <!-- For Renters -->
    <div>
      <h4 class="text-white font-bold mb-6 text-2xl md:text-xl tracking-wide">For Renters</h4>
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

<!-- Scripts -->
<script>
  window.addEventListener('load', () => {
    document.body.classList.add('loaded');
  });

  document.addEventListener("DOMContentLoaded", function () {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
    });

    document.querySelectorAll('.animate-on-scroll, .animate-item').forEach(el => {
      observer.observe(el);
    });
  });
</script>
</body>
</html>

</body>
</html>
