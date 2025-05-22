<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\LoanCalculatorController;
use App\Http\Controllers\TemperatureCalculatorController;

// Halaman awal langsung ke kalkulator suhu
Route::get('/', [TemperatureCalculatorController::class, 'index'])->name('temperature.index');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');

// CRUD Task (Item)
Route::post('/item', [ItemController::class, 'insert'])->name('item.store');               // Simpan task baru
Route::delete('/item/{id}', [ItemController::class, 'delete'])->name('item.destroy');      // Hapus task
Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');         // Tampilkan form edit
Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update');          // Update task

// Kalkulator Biasa
Route::get('/calculator', [CalculatorController::class, 'index']);
Route::post('/calculator', [CalculatorController::class, 'calculate']);

// Kalkulator Pinjaman
Route::get('/loan', [LoanCalculatorController::class, 'index']);
Route::post('/loan', [LoanCalculatorController::class, 'calculate']);

// Kalkulator Suhu
Route::get('/temperature-calculator', [TemperatureCalculatorController::class, 'index']);
Route::post('/temperature-calculator', [TemperatureCalculatorController::class, 'convert']);
