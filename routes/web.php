<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TechnicalController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/technical', [TechnicalController::class, 'index'])->name('technical.index');
    Route::get('/technical/{technicalOffer}/view', [TechnicalController::class, 'view'])->name('technical.view');
    Route::get('/technical/create', [TechnicalController::class, 'create'])->name('technical.create');
    Route::post('/technical/store', [TechnicalController::class, 'store'])->name('technical.store');
    Route::get('/technical/{technicalOffer}/edit', [TechnicalController::class, 'edit'])->name('technical.edit');
    Route::put('/technical/update/{technicalOffer}', [TechnicalController::class, 'update'])->name('technical.update');
    Route::delete('/technical/destroy/{technicalOffer}', [TechnicalController::class, 'destroy'])->name('technical.destroy');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
