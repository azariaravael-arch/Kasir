<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ReportController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== POS/KASIR ROUTES ====================
Route::middleware(['auth'])->group(function(){
    // POS Interface
    Route::get('/pos', [SaleController::class, 'index'])->name('pos.index');
    Route::get('/pos/search', [SaleController::class, 'search'])->name('pos.search');
    Route::post('/pos', [SaleController::class, 'store'])->name('pos.store');
    Route::post('/pos/hold', [SaleController::class, 'hold'])->name('pos.hold');
    Route::get('/pos/held', [SaleController::class, 'held'])->name('pos.held');
    Route::get('/pos/helds', [SaleController::class, 'heldPage'])->name('pos.heldPage');
    Route::post('/pos/{sale}/resume', [SaleController::class, 'resume'])->name('pos.resume');
    Route::get('/pos/{sale}', [SaleController::class, 'show'])->name('pos.show');
    Route::get('/pos/{sale}/receipt', [SaleController::class, 'receipt'])->name('pos.receipt');
});

// ==================== ADMIN ONLY ROUTES ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){
    // Product Management
    Route::resource('products', ProductController::class);
    Route::get('products/search', [ProductController::class, 'search'])->name('products.search');
    
    // Reports
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/chart-data', [ReportController::class, 'chartData'])->name('reports.chartData');
});

require __DIR__.'/auth.php';
