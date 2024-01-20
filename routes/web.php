<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\InvoicesController;

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
})->name('dashboard');

// product 
Route::get('product/list',[ProductController::class , 'index'])->name('productList');
Route::post('create/product',[ProductController::class , 'store'])->name('addProduct');
Route::patch('edit/product',[ProductController::class , 'update'])->name('updateProduct');
Route::delete('delete/product',[ProductController::class , 'destroy'])->name('deleteProduct');

// Client 
Route::get('client/list',[ClientController::class , 'index'])->name('clientList');
Route::post('create/client',[ClientController::class , 'store'])->name('addClient');
Route::patch('edit/client',[ClientController::class , 'update'])->name('updateClient');
Route::delete('delete/client',[ClientController::class , 'destroy'])->name('deleteClient');

// Invoices
Route::get('invoices/list',[InvoicesController::class , 'index'])->name('invoicesList');
Route::post('create/invoices',[InvoicesController::class , 'store'])->name('addinvoices');


