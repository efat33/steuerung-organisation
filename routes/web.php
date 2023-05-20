<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TechnicalController;
use App\Http\Controllers\MaintenanceController;
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

    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('/maintenance/{maintenanceOffer}/view', [MaintenanceController::class, 'view'])->name('maintenance.view');
    Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('/maintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::get('/maintenance/{maintenanceOffer}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::put('/maintenance/update/{maintenanceOffer}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::delete('/maintenance/destroy/{maintenanceOffer}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
