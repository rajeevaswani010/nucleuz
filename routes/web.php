<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingInviteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get("ChangeLanguage/{lang}", [HomeController::class, 'ChangeLanguage']);

Route::get('login', [HomeController::class, 'Login']);

Route::get('reset-password', function () {
    return view('ResetPassword');
});

Route::post('login', [HomeController::class, 'DoLogin']);
Route::post('DoReset', [HomeController::class, 'DoReset']);
Route::get('SetPassword/{token}', [HomeController::class, 'SetPassword']);
Route::post('DoSetPassword', [HomeController::class, 'DoSetPassword']);

Route::get('/ChangePassword', [HomeController::class, 'ChangePassword']);
Route::post('/ChangePassword/SavePass', [HomeController::class, 'SavePassword']);


Route::get('logout', [HomeController::class, 'logout']);
Route::get('ReadNotification', [HomeController::class, 'ReadNotification']);

Route::get('CustomerRegister/{ID}', [CustomerController::class, 'register']);
Route::post('CustomerRegister', [CustomerController::class, 'registerPost']);
Route::get('thank-you', function(){
    return view("thank-you");
});


Route::get('dashboard', [DashboardController::class, 'index']);
Route::resource('office', OfficeController::class);
Route::resource('license', LicenseController::class);

Route::resource('product', ProductController::class);

Route::post('UpdateSubscription', [LicenseController::class, 'UpdateSubscription']);
Route::resource('staff', StaffController::class);
Route::resource('role', RoleController::class);
Route::get('vehicle/Exports', [VehicleController::class, 'Exports']);
Route::post('UplaodVehicle', [VehicleController::class, 'Import']);
Route::resource('vehicle', VehicleController::class);
Route::get('pricing/Export', [PricingController::class, 'Export']);
Route::post('UploadPricing', [PricingController::class, 'Import']);
Route::resource('pricing', PricingController::class);
Route::resource('booking', BookingController::class);
Route::resource('booking-invite', BookingInviteController::class);
Route::post('booking-invite/add', [BookingInviteController::class,'add']);
Route::post('Booking/Review', [BookingController::class, 'review']);
Route::post('Booking/GetAvailableCarTypes', [BookingController::class, 'GetAvailableCarTypes']);
Route::get('Vehicle/GetAllCarTypes', [VehicleController::class, 'GetAllCarTypes']);
Route::get("BookingCancel/{ID}", [BookingController::class, 'CancelBooking']);
Route::post('Customer/Review', [BookingController::class, 'ReviewCustomer']);
Route::post('BookingExceed/{id}', [BookingController::class, 'BookingExceed']);
Route::get('Booking/Get', [DashboardController::class, 'GetBookings']);

//===========my new code==================================//
Route::get('bookingreciepts', [BookingController::class, 'BookingReciept']);
Route::get('bookinginvoice', [BookingController::class, 'BookingInvoice']);

Route::get('customer/Exports', [CustomerController::class, 'Exports']);
Route::post('CustomerSearch', [CustomerController::class, 'Search']);
Route::resource('customer', CustomerController::class);
Route::resource('brand', BrandController::class);
Route::post('UplaodBrand', [BrandController::class, 'Import']);
Route::get('reports', [ReportController::class, 'View']);

