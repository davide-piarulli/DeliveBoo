<?php

use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\TypeController;



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
});

// Rotte protette da autenticazione e verifica email
Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {

    // Dashboard e profilo
    Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Rotte CRUD prodotti
    Route::resource('products', ProductController::class);

    Route::resource('restaurants', RestaurantController::class);

    // Rotte CRUD custom
    Route::get('/order-by/{col}/{dir}', [ProductController::class, 'orderBy'])->name('order-by');

  });

// Rotte per il profilo utente
Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
