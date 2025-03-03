<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

// All Category Route
Route::controller(CategoryController::class)->group(function() {
    Route::get('category', 'index')->name('get-category');
    Route::get('create-category', 'create')->name('create-category');
    Route::post('store-category', 'store')->name('store-category');
    Route::get('edit-category/{id}', 'edit')->name('edit-category');
    Route::put('update-category/{id}', 'update')->name('update-category');
    Route::delete('delete-category/{id}', 'destroy')->name('delete-category');
});

// All Medicine Route
Route::controller(MedicineController::class)->group(function() {
    Route::get('get-medicine', 'index')->name('get-medicine');
    Route::get('create-medicine', 'create')->name('create-medicine');
    Route::post('store-medicine', 'store')->name('store-medicine');
    Route::get('edit-medicine/{id}', 'edit')->name('edit-medicine');
    Route::put('update-medicine/{id}', 'update')->name('update-medicine');
    Route::delete('delete/medicine/{id}', 'destroy')->name('delete.medicine');
    Route::get('view/detail/{id}', 'show')->name('view.detail');
});

// All Cart Route
Route::controller(CartController::class)->group(function() {
    Route::get('get/cart', 'index')->name('get.cart');
    Route::get('create/cart', 'create')->name('create.cart');
    Route::post('store/cart', 'store')->name('store.cart');
});
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/',[MedicineController::class, 'index']);
require __DIR__.'/auth.php';
