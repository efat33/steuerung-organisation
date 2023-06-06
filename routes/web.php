<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TechnicalController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\DashboardController;
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
    // Users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Technical
    Route::get('/technical', [TechnicalController::class, 'index'])->name('technical.index');
    Route::get('/technical/{technicalOffer}/view', [TechnicalController::class, 'view'])->name('technical.view');
    Route::get('/technical/create', [TechnicalController::class, 'create'])->name('technical.create');
    Route::post('/technical/store', [TechnicalController::class, 'store'])->name('technical.store');
    Route::get('/technical/{technicalOffer}/edit', [TechnicalController::class, 'edit'])->name('technical.edit');
    Route::put('/technical/update/{technicalOffer}', [TechnicalController::class, 'update'])->name('technical.update');
    Route::delete('/technical/destroy/{technicalOffer}', [TechnicalController::class, 'destroy'])->name('technical.destroy');

    // Maintenance
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('/maintenance/{maintenanceOffer}/view', [MaintenanceController::class, 'view'])->name('maintenance.view');
    Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('/maintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::get('/maintenance/{maintenanceOffer}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::put('/maintenance/update/{maintenanceOffer}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::delete('/maintenance/destroy/{maintenanceOffer}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

    // Dashboard
    Route::get('/dashboard/success-rate', [DashboardController::class, 'success'])->name('dashboard.success');
    Route::post('/dashboard/success-rate', [DashboardController::class, 'successAction'])->name('dashboard.success');
    Route::get('/dashboard/quote-time', [DashboardController::class, 'quoteTime'])->name('dashboard.quote-time');
    Route::post('/dashboard/quote-time', [DashboardController::class, 'quoteTimeAction'])->name('dashboard.quote-time');
    Route::get('/dashboard/employee-evaluation', [DashboardController::class, 'employeeEvaluation'])->name('dashboard.employee-evaluation');
    Route::post('/dashboard/employee-evaluation', [DashboardController::class, 'employeeEvaluationAction'])->name('dashboard.employee-evaluation');
    Route::get('/dashboard/ktb-evaluation', [DashboardController::class, 'ktbEvaluation'])->name('dashboard.ktb-evaluation');
    Route::post('/dashboard/ktb-evaluation', [DashboardController::class, 'ktbEvaluationAction'])->name('dashboard.ktb-evaluation');
    Route::get('/dashboard/difference', [DashboardController::class, 'difference'])->name('dashboard.difference');
    Route::post('/dashboard/difference', [DashboardController::class, 'differenceAction'])->name('dashboard.difference');
    Route::get('/dashboard/evaluation-received-via', [DashboardController::class, 'receivedVia'])->name('dashboard.evaluation-received-via');
    Route::post('/dashboard/evaluation-received-via', [DashboardController::class, 'receivedViaAction'])->name('dashboard.evaluation-received-via');
    Route::get('/dashboard/evaluation-result-after-interview', [DashboardController::class, 'evaluationAfterInterview'])->name('dashboard.evaluation-result-after-interview');
    Route::post('/dashboard/evaluation-result-after-interview', [DashboardController::class, 'evaluationAfterInterviewAction'])->name('dashboard.evaluation-result-after-interview');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';