<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HouseOwnerController;
use App\Http\Controllers\HouseownerloginController;
 use App\Http\Controllers\CustomerLoginController;
 use App\Http\Controllers\PropertyImageController;
 use App\Http\Controllers\BookingController;
 use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Models\Property;



//Route::get('/', function () {
   // return view('admin.pencustomer');
//})->name('admin.pencustomer');

//Route::get('/', function () {
   // return view('admin.pendhouseowner');
//})->name('admin.pendhouseowner');

// Use the same controller for both `/` and `/home`
Route::get('/home', [HomeController::class, 'index']);


//Route::get('/', function () {
   // return view('admin.viewdetails');
//})->name('admin.viewdetails');

Route::get('/test-view', function () {
    return view('admin.pencustomer');
});

Route::get('/renter', function () {
    return view('renter');
})->name('renter');

Route::get('/owner', function () {
    return view('owner');
})->name('owner');

Route::get('/choose', function () {
    return view('choose');  // loads resources/views/choose.blade.php
});
Route::get('/owner', function () {
    return view('owner');  // Make sure you have resources/views/owner.blade.php
})->name('owner.page');



Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

// Listings
Route::get('/listings', [ListingController::class, 'index'])->name('listings');
Route::get('/listing/{id}', [ListingController::class, 'show'])->name('listing.show');

Route::get('/add-listing', [ListingController::class, 'create'])->name('add-listing');

// Property creation by house owner (public form)
Route::get('/properties/create', fn() => view('owner'))->name('properties.create');
Route::post('/properties/store', [PropertyController::class, 'store'])->name('properties.store');

// Customer registration (public)
Route::get('/customers/register', [CustomerController::class, 'create'])->name('customer.register');
Route::post('/customers/register', [CustomerController::class, 'store'])->name('customer.store');


Route::view('/details', 'details');
Route::view('/choose', 'choose');
Route::view('/customerlogin', 'customerlogin');
 
//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowner.register');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Pending Properties
    Route::get('/pending-properties', [AdminController::class, 'showPending'])->name('admin.pending-properties');
    Route::get('/pending-properties/{id}', [AdminController::class, 'show'])->name('admin.properties.show');
    Route::post('/pending-properties/{id}/approve', [AdminController::class, 'approve'])->name('admin.properties.approve');
    Route::post('/pending-properties/{id}/reject', [AdminController::class, 'reject'])->name('admin.properties.reject');

    // Approved properties list (only one definition)
    Route::get('/properties/approved', [AdminController::class, 'approvedProperties'])->name('admin.properties.approved');

    // routes/web.php

Route::get('/pending-properties/{id}', [AdminController::class, 'show'])->name('admin.properties.show');

    // Owners list
    Route::get('/owners', [AdminController::class, 'ownersList'])->name('admin.owners');

  Route::post('/customers/register', [CustomerController::class, 'store'])->name('customer.store');
   Route::get('admin/pending-customers', [RenterController::class, 'pendingCustomers'])->name('pencustomer.index');

Route::post('/houseowners/store', [HouseOwnerController::class, 'store'])->name('houseowners.store');

Route::get('/admin/active-customers', [RenterController::class, 'activeCustomers'])->name('admin.active-customers');
Route::get('/admin/pending-customers', [RenterController::class, 'pendingCustomers'])->name('admin.pending-customers');
Route::post('/admin/customer/{id}/accept', [RenterController::class, 'accept'])->name('admin.customer.accept');
Route::delete('/admin/pencustomer/{id}/delete', [RenterController::class, 'delete'])->name('pencustomer.delete');

    // Customer management (approve/delete)
    Route::post('/customers/{id}/approve', [AdminController::class, 'approveCustomer'])->name('admin.customers.approve');
    Route::delete('/customers/{id}/delete', [AdminController::class, 'deleteCustomer'])->name('admin.customers.delete');



// Admin PropertyController routes (if needed, else handled by AdminController)
Route::post('/admin/properties/{id}/approve', [PropertyController::class, 'approve'])->name('admin.properties.approve');
Route::get('/admin/properties/pending', [PropertyController::class, 'pending'])->name('admin.properties.pending');

// Avoid duplicates of /listings and others
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::get('/admin/pending', [AdminController::class, 'pending'])->name('admin.pending');
Route::get('/admin/pending-properties', [AdminController::class, 'showPending'])->name('admin.pending');


Route::get('/houseowner/login', function () {
    return view('ownerslogin'); // matches ownerslogin.blade.php
})->name('houseowners.login.form');

// Accept a pending customer
Route::post('/admin/pending-customer/accept/{id}', [RenterController::class, 'accept'])->name('pencustomer.accept');

// Route to active customers page
Route::get('/admin/active-customers', [CustomerController::class, 'showActive'])->name('admin.actcustomer');

Route::get('/admin/customers/active', [CustomerController::class, 'activeCustomers'])->name('customers.active');

Route::get('/active-customers', [RenterController::class, 'activeCustomers'])->name('active.customers');

Route::get('/admin/active-customers', [CustomerController::class, 'activeCustomers'])->name('active.customers');
Route::post('/admin/pending-customers/accept/{id}', [CustomerController::class, 'acceptPendingCustomer'])->name('pencustomer.accept');
Route::delete('/admin/pending-customers/delete/{id}', [CustomerController::class, 'deletePendingCustomer'])->name('pencustomer.delete');

Route::get('/admin/active-customers', [CustomerController::class, 'showActive'])->name('admin.active-customers');

Route::get('/admin/active-customers', [CustomerController::class, 'showActive'])->name('admin.actcustomer');
Route::get('admin/pending-customers', [RenterController::class, 'pendingCustomers'])->name('pending.customers');

Route::get('/choose', function () {
    return view('choose');
})->name('choose');


// Show the registration form
//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowners.create');

// Admin: View pending house owners
Route::get('/admin/pending-houseowners', [HouseOwnerController::class, 'pendingOwners'])->name('houseowners.pending');

// Admin: Accept house owner
Route::post('/admin/houseowners/accept/{id}', [HouseOwnerController::class, 'accept'])->name('houseowners.accept');

// Admin: Delete house owner
Route::delete('/admin/houseowners/delete/{id}', [HouseOwnerController::class, 'delete'])->name('houseowners.delete');


Route::post('/houseowners/store', [HouseOwnerController::class, 'store'])->name('houseowners.store');
Route::get('/admin/houseowners/approved', [HouseOwnerController::class, 'approvedOwners'])->name('houseowners.approved');

Route::get('/houseowner/login', [HouseownerloginController::class, 'showLoginForm'])->name('houseowner.login');
Route::post('/houseowner/login', [HouseownerloginController::class, 'login'])->name('houseowner.login.submit');



//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowners.register.form');
//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowners.create');
//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowners.register.form');
Route::view('/owners/login', 'ownerslogin')->name('owners.login');
// Show renter registration form
Route::get('/renter/register', function () {
    return view('renter');  // loads resources/views/renter.blade.php
})->name('renter.register.form');
// routes/web.php

Route::get('/customer/register', function () {
    return view('renter');
})->name('customer.register.form');

Route::get('/customerlogin', function () {
    return view('customerlogin');
})->name('customer.login');

Route::get('/customer/login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login.form');
Route::post('/customer/login', [CustomerLoginController::class, 'login'])->name('customer.login.submit');

Route::get('/customer/listings', function () {
    return view('listings.index'); // note the dot notation for subfolders
})->name('customer.listings');

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/listings', [ListingController::class, 'index'])->name('listings');
});

//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowners.create');

// In routes/web.php or routes/houseowner.php if you use a route group
Route::middleware(['auth:houseowner'])->prefix('houseowner')->name('houseowner.')->group(function () {
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    // other houseowner routes here
});
//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowner.register');

//Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowners.register.form');

Route::get('/listings', [PropertyController::class, 'index'])->name('listings');

// Route to update order
Route::post('/admin/property-images/reorder', [PropertyImageController::class, 'reorder'])->name('property-images.reorder');

// Route to set main image
Route::post('/admin/property-images/{id}/set-main', [PropertyImageController::class, 'setMain'])->name('property-images.set-main');

Route::post('/property-images/reorder', [PropertyImageController::class, 'reorder'])->name('property-images.reorder');

Route::get('/book-property/{propertyid}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/book-property', [BookingController::class, 'store'])->name('bookings.store');

Route::get('/admin/bookings', [AdminController::class, 'showBookings'])->name('admin.bookings');

// Route to handle Send to Owner action
Route::post('/admin/bookings/{id}/send-to-owner', [App\Http\Controllers\AdminController::class, 'sendToOwner'])->name('admin.bookings.sendToOwner');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/contact', function () {
    return view('contact'); // or use a controller if you want
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/admin/contact-messages', [ContactController::class, 'showMessages'])->name('admin.contact.messages');
Route::post('/contact/{id}/mark-as-read', [ContactController::class, 'markAsRead'])->name('contact.markAsRead');

Route::get('/all-properties', [AdminController::class, 'allApprovedProperties'])->name('admin.all-properties');
Route::post('/admin/properties/{property}/images', [AdminController::class, 'storePropertyImages'])->name('admin.properties.images.store');

Route::post('/houseowners/store', [HouseOwnerController::class, 'store'])->name('houseowners.store');

Route::get('/houseowner/register', [HouseOwnerController::class, 'create'])->name('houseowners.register.form');


Route::get('/admin/all-properties/{id}', [AdminController::class, 'showApprovedProperty'])->name('admin.properties.approved.show');

Route::get('/admin/approved-property/{id}', [AdminController::class, 'showApprovedProperty'])->name('admin.approved.property.show');

Route::get('/admin/pending-customers', [CustomerController::class, 'pendingCustomers'])->name('admin.pending-customers');
Route::get('/admin/customers/active', [CustomerController::class, 'activeCustomers'])->name('admin.customers.active');
// For pending customers page
Route::get('/admin/customers/pending', [CustomerController::class, 'pendingCustomers'])->name('admin.customers.pending');

// Show the admin login form
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');

// Handle the login form submission
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Show the admin dashboard (only if logged in)
Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

// Admin logout
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::post('/admin/pending-customers/accept/{id}', [RenterController::class, 'accept'])->name('pencustomer.accept');
Route::delete('/admin/pending-customers/delete/{id}', [RenterController::class, 'delete'])->name('pencustomer.delete');

Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.details');


Route::get('/', [HomeController::class, 'index'])->name('home');
