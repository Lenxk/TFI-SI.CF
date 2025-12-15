<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductBatchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);

    // Lotes de producto (gestión de stock por producto)
    Route::resource('products.batches', ProductBatchController::class)->shallow();
});

Route::resource('purchases', PurchaseController::class);

Route::resource('sales', SaleController::class)->middleware('auth');

Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
Route::get('/reports/sales/export', [ReportController::class, 'exportSales'])->name('reports.sales.export');

Route::get('/reports/purchases', [ReportController::class, 'purchases'])->name('reports.purchases');
Route::get('/reports/purchases/export', [ReportController::class, 'exportPurchases'])->name('reports.purchases.export');

Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');

Route::resource('suppliers', SupplierController::class);

Route::resource('customer-sales', CustomerSaleController::class);


require __DIR__.'/auth.php';
