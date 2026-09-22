<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Hari Om Computer Customer Storefront
|--------------------------------------------------------------------------
*/

Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/computers', 'computers')->name('computers');
    Route::get('/laptops', 'laptops')->name('laptops');
    Route::get('/components', 'components')->name('components');
    Route::get('/products', 'products')->name('products');
    Route::get('/product-details', 'productDetails')->name('product.details');
    Route::get('/pc-builder', 'pcBuilder')->name('pc.builder');
    Route::get('/enquiry', 'enquiry')->name('enquiry');
    Route::get('/quotation-success', 'quotationSuccess')->name('quotation.success');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});
