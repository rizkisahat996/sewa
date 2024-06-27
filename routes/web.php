<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [FrontendController::class, 'index'])->name('building');
Route::get('/items', [FrontendController::class, 'items'])->name('items');
Route::get('/items/filter', [FrontendController::class, 'filterItems'])->name('items.filter');
Route::get('/items/{id}', [FrontendController::class, 'show'])->name('building.show');
Route::post('/items/rent', [FrontendController::class, 'rentBuilding'])->name('building.rent')->middleware('auth');
Route::get('/payment/{id}', [FrontendController::class, 'payment'])->name('payment')->middleware('auth');
Route::post('/generate-invoice', [FrontendController::class, 'generateInvoice'])->name('generate.invoice')->middleware('auth');
Route::get('/invoice/{id}', [FrontendController::class, 'viewInvoice'])->name('view.invoice')->middleware('auth');
Route::get('/create-listing', [FrontendController::class, 'createListing'])->name('create.listing')->middleware('auth');
Route::post('/store-listing', [FrontendController::class, 'storeListing'])->name('store.listing')->middleware('auth');
Route::get('/user-transactions', [FrontendController::class, 'userTransactions'])->name('user.transactions');

Auth::routes();
