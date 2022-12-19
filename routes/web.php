<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoiceAttachmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
// Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices',InvoiceController::class);
Route::get('invoices/create',[InvoiceController::class,'create'])->name('invoices.create');
Route::get('sections/{id}', [InvoiceController::class,'getProducts']);


Route::resource('sections',SectionsController::class);
Route::post('sections',[SectionsController::class,'store'])->name('sections.store');
Route::delete('sections/{section}',[SectionsController::class,'destroy'])->name('sections.destroy');



Route::resource('products',ProductController::class);
// Route::post('products',[ProductController::class,'store'])->name('products.store');
Route::put('products/{product}',[ProductController::class,'update'])->name('products.update');
Route::delete('products/{product}',[ProductController::class,'destroy'])->name('products.destroy');

Route::get('invoices/{invoice}/details',[InvoiceDetailController::class,'show'])->name('invoice.details');
Route::get('invoices/viewfile/{number}/{name}',[InvoiceDetailController::class,'viewFile'])->name('invoices.viewfile');
Route::get('invoices/downloadfile/{number}/{name}',[InvoiceDetailController::class,'downloadFile'])->name('invoices.downloadfile');
Route::post('invoices/files',[InvoiceDetailController::class,'destroy'])->name('files.destroy');

Route::post('invoices/attachments',[InvoiceAttachmentController::class,'store'])->name('invoicesattachments.store');




Route::get('/{page}', [AdminController::class,'index']);



