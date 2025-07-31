<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rentalz | Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        input:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.4);
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
<body class="bg-white text-gray-800">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm py-4 px-10 flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-800">Rentalz</div>
        <ul class="flex space-x-6 font-medium text-gray-700">
            <li><a href="{{ route('home') }}" class="hover:text-red-500">Home</a></li>
            <li><a href="{{ route('listings') }}" class="hover:text-red-500">Listings</a></li>
            <li><a href="{{ route('about') }}" class="hover:text-red-500">About Us</a></li>
           <li>
  <span class="text-red-500 font-semibold cursor-default select-none">Contact</span>
</li>

        </ul>
        <div class="flex items-center space-x-4">
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-16 bg-gray-50">
        <h1 class="text-4xl font-bold mb-4">We'd Love to Hear From You</h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Reach out with questions, suggestions, or just say hello! We’re here to help make your rental journey smooth.</p>
    </section>

    <!-- Contact Section -->
    <section class="max-w-6xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-2 gap-12">
        
        <!-- Contact Info + Social -->
        <div class="space-y-8">
            <div>
                <h2 class="text-2xl font-bold mb-2">Contact Information</h2>
                <p class="text-gray-600">Our support team is available Monday to Friday, 9AM–6PM PST.</p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Email:</h4>
                <p class="text-gray-600">support@rentalz.com</p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Phone:</h4>
                <p class="text-gray-600">+94 770234234</p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Address:</h4>
                <p class="text-gray-600">123 Colombo Road, 5th Floor<br>
Colombo 03, Western Province<br>
Sri Lanka<br>
Postal Code: 00300</p>
            </div>

            <!-- Social Media -->
            <div class="pt-4">
                
              
            </div>
        </div>


       <!-- Contact Form -->
<form method="POST" action="{{ route('contact.submit') }}">
    @csrf

    <!-- Success Message -->
    @if(session('status'))
        <div class="bg-green-100 text-green-800 p-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label for="name" class="block font-semibold mb-1">Name</label>
        <input type="text" id="name" name="name" placeholder="Your Name" class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>
    <div>
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>
    <div>
        <label for="message" class="block font-semibold mb-1">Message</label>
        <textarea id="message" name="message" rows="4" placeholder="Your message..." class="w-full border border-gray-300 rounded px-4 py-2" required></textarea>
    </div>
    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded">Send Message</button>
</form>

    </section>

   <div class="mt-8 text-sm text-gray-700 bg-gray-50 border border-gray-200 p-4 rounded">
    <p class="mb-2 font-medium text-gray-800">📘 Need guidance using Rentalz?</p>
    <a href="/pdfs/rentalz-help-guide.pdf" target="_blank" class="text-indigo-600 hover:underline">
        View the Rentalz Help Guide (PDF)
    </a>
</div>

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
