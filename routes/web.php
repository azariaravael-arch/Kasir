<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ReportController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/master', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('master');

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

// ==================== PURCHASE/PEMBELIAN ROUTES ====================
Route::middleware(['auth'])->prefix('purchase')->group(function(){
    // Purchase Management
    Route::get('/', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::put('/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::post('/{purchase}/receive', [PurchaseController::class, 'receive'])->name('purchases.receive');
    Route::post('/{purchase}/cancel', [PurchaseController::class, 'cancel'])->name('purchases.cancel');
    Route::delete('/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    
    // API for autocomplete
    Route::get('/api/products', [PurchaseController::class, 'searchProducts'])->name('purchases.api.products');
    Route::get('/api/product/{product}', [PurchaseController::class, 'getProduct'])->name('purchases.api.product');
});

// ==================== SUPPLIER ROUTES ====================
Route::middleware(['auth'])->prefix('supplier')->group(function(){
    Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

// ==================== RETURN/RETUR ROUTES ====================
Route::middleware(['auth'])->prefix('return')->group(function(){
    Route::get('/', [ReturnController::class, 'index'])->name('returns.index');
    Route::get('/create', [ReturnController::class, 'create'])->name('returns.create');
    Route::post('/', [ReturnController::class, 'store'])->name('returns.store');
    Route::get('/{return}', [ReturnController::class, 'show'])->name('returns.show');
    Route::get('/{return}/edit', [ReturnController::class, 'edit'])->name('returns.edit');
    Route::put('/{return}', [ReturnController::class, 'update'])->name('returns.update');
    Route::post('/{return}/approve', [ReturnController::class, 'approve'])->name('returns.approve');
    Route::post('/{return}/reject', [ReturnController::class, 'reject'])->name('returns.reject');
    Route::delete('/{return}', [ReturnController::class, 'destroy'])->name('returns.destroy');
    
    // API for purchase items
    Route::get('/api/purchase/{purchase}/items', [ReturnController::class, 'getPurchaseItems'])->name('returns.api.items');
});

// ==================== CATEGORY ROUTES ====================
Route::middleware(['auth'])->prefix('category')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// ==================== CUSTOMER ROUTES ====================
Route::middleware(['auth'])->prefix('customer')->group(function(){
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});

// ==================== ADMIN ONLY ROUTES ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){
    // Product Management
    Route::resource('products', ProductController::class);
    Route::get('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::post('api/categories', [ProductController::class, 'storeCategory'])->name('categories.store.api');
    Route::get('api/categories', [ProductController::class, 'getCategories'])->name('categories.get.api');
    
    // Reports
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/chart-data', [ReportController::class, 'chartData'])->name('reports.chartData');
});

require __DIR__.'/auth.php';
