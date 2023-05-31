<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController, App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->middleware(['auth', 'verified'])->name('about');

Route::post('/add_item', [CartController::class, 'addItem'])->middleware(['auth', 'verified'])->name('addItem');
Route::post('/substract_item', [CartController::class, 'substractitem'])->middleware(['auth', 'verified'])->name('substractitem');
Route::post('/add_to_cart', [CartController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('addToCart');
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth', 'verified'])->name('cart');

Route::get('/cart', [CartController::class, 'index'])->middleware(['auth', 'verified'])->name('cart');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
