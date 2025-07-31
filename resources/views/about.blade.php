<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rentalz | About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    h1, h2, p {
      background: none;
      box-shadow: none;
      outline: none;
      border: none;
    }

    body {
      background-color: white;
      margin: 0;
    }

    .section {
      padding: 4rem 1rem;
    }

    footer {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

footer.visible {
  opacity: 1;
  transform: translateY(0);
}

  </style>
</head>
<body class="text-gray-800">

  <!-- Navigation Bar -->
  <nav class="bg-white shadow-sm py-4 px-10 flex justify-between items-center">
    <div class="text-2xl font-bold text-gray-800">Rentalz</div>
    <ul class="flex space-x-6 font-medium text-gray-700">
      <li><a href="{{ route('home') }}" class="hover:text-red-500">Home</a></li>
      <li><a href="{{ route('listings') }}" class="hover:text-red-500">Listings</a></li>
      <li>
  <span class="text-red-500 font-semibold cursor-default select-none">About Us</span>
</li>

      <li><a href="{{ route('contact') }}" class="hover:text-red-500">Contact</a></li>
    </ul>
    <div class="flex items-center space-x-4">
      
    </div>
  </nav>

  <!-- About Us Section -->
  <section class="section text-center">
    <h1 class="text-4xl font-bold text-gray-900 mb-6">About Us</h1>
    <p class="text-lg max-w-3xl mx-auto text-gray-700">At Rentalz, we’re committed to connecting renters with quality homes and ensuring a smooth experience for all users. We focus on trust, transparency, and comfort.</p>
  </section>

  <!-- Our Values -->
  <section class="section bg-gray-50">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
      <div>
        <img src="https://cdn.prod.website-files.com/6492719dbfcc54669c62f0ea/64928b412b453df40f1c598c_service.webp" alt="Quality Homes" class="mx-auto h-24 mb-4" />
        <h3 class="text-xl font-semibold mb-2">Quality Homes</h3>
        <p class="text-gray-600">Find a variety of hand-picked, quality homes suited for every lifestyle.</p>
      </div>
      <div>
        <img src="https://cdn.prod.website-files.com/6492719dbfcc54669c62f0ea/6492d8152fe6af1ddd410017_search.png" alt="Excellent Services" class="mx-auto h-24 mb-4" />
        <h3 class="text-xl font-semibold mb-2">Excellent Services</h3>
        <p class="text-gray-600">We’re here to assist you from search to move-in, with excellent support.</p>
      </div>
      <div>
        <img src="https://cdn.prod.website-files.com/6492719dbfcc54669c62f0ea/6492d8152fe6af1ddd410014_honesty.png" alt="Trusted Name" class="mx-auto h-24 mb-4" />
        <h3 class="text-xl font-semibold mb-2">Trusted Name</h3>
        <p class="text-gray-600">Trusted by thousands across the country for reliable rental experiences.</p>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="section text-center bg-gray-100">
    <h2 class="text-3xl font-bold mb-4">Rent with Us Today</h2>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto mb-6">We provide a wide variety of rental options at affordable rates with unbeatable customer service.</p>
    <a href="{{ route('listings') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded text-lg">View Listings</a>
  </section>

  @include('footer')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('footer');

    function checkFooterVisibility() {
      const rect = footer.getBoundingClientRect();
      const windowHeight = window.innerHeight || document.documentElement.clientHeight;

      // Check if footer is in viewport
      if (rect.top <= windowHeight && rect.bottom >= 0) {
        footer.classList.add('visible');
      }
    }

    window.addEventListener('scroll', checkFooterVisibility);
    window.addEventListener('resize', checkFooterVisibility);

    // Initial check in case footer is already visible
    checkFooterVisibility();
  });
</script>


</body>
</html>
