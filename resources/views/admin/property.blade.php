@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Rentalz Admin - Pending Properties</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
<style>
body {
font-family: 'Inter', sans-serif;
}
</style>
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
<!-- Sidebar -->
<aside class="w-64 bg-white shadow-lg p-6">
<h1 class="text-2xl font-bold mb-10 text-indigo-600">Rentalz</h1>
<nav class="space-y-6">
<a href="#" class="flex items-center font-semibold text-indigo-600">
<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8" />
</svg>
Dashboard
</a>
<a href="#" class="flex items-center text-indigo-600 font-semibold">
<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
</svg>
Properties
</a>
<a href="#" class="flex items-center text-gray-700 hover:text-indigo-500">
<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
</svg>
Customers
</a>
<a href="#" class="flex items-center text-gray-700 hover:text-indigo-500">
<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
</svg>
House Owners
</a>
<a href="#" class="flex items-center text-gray-700 hover:text-indigo-500">
<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a2 2 0 012-2h14a2 2 0 012 2v16l-8-4-8 4V4z" />
</svg>
Reviews
</a>
</nav>
</aside>


<!-- Tabs -->
<div class="mb-4 border-b border-gray-300">
<nav class="flex space-x-4" aria-label="Tabs">
<a href="#" class="py-2 px-3 border-b-2 border-transparent text-gray-600 hover:text-indigo-600 hover:border-indigo-600 font-semibold">All Properties</a>
<a href="#" class="py-2 px-3 border-b-2 border-indigo-600 text-indigo-600 font-semibold" aria-current="page">Pending Properties</a>
</nav>
</div>

<!-- Property Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
@forelse ($properties as $property)
<div class="bg-white rounded-xl shadow-md p-5 border border-gray-200">
<!-- House Image -->
@if($property->image)
<img src="{{ asset('storage/' . $property->image) }}" alt="House Photo" class="w-full h-40 object-cover rounded-md mb-3">
@endif

<h3 class="text-lg font-bold text-indigo-600 mb-1">{{ $property->title }}</h3>
<p class="text-sm text-gray-700 mb-1">{{ Str::limit($property->description, 100) }}</p>
<p class="text-xs text-gray-500 mb-2">Status: <span class="font-medium capitalize">{{ $property->status }}</span></p>

<!-- Owner Info -->
<div class="flex items-center space-x-3 mb-4">
@if($property->owner_photo)
<img src="{{ asset('storage/' . $property->owner_photo) }}" alt="Owner Photo" class="w-10 h-10 rounded-full object-cover">
@endif
<div>
<p class="text-sm font-semibold text-gray-800">{{ $property->owner_name }}</p>
<p class="text-xs text-gray-500">{{ $property->owner_contact }}</p>
</div>
</div>

<!-- Action Buttons -->
<div class="flex items-center space-x-3">
<a href="{{ route('admin.properties.show', $property->id) }}"
class="text-sm text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
View Details
</a>

<form method="POST" action="{{ route('admin.properties.approve', $property->id) }}">
@csrf
<button type="submit" class="text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
Approve
</button>
</form>

<form method="POST" action="{{ route('admin.properties.reject', $property->id) }}">
@csrf
<button type="submit" class="text-sm bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
Reject
</button>
</form>
</div>
</div>
@empty
<div class="col-span-full text-center text-gray-500 text-lg">
No pending properties found.
</div>
@endforelse
</div>
</main>
</div>
</body>
</html>
