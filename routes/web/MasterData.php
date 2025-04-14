<?php

use App\Http\Controllers\MasterData\BusinessPartnerController;
use App\Http\Controllers\MasterData\CashAccountController;
use App\Http\Controllers\MasterData\PriceLevelController;
use App\Http\Controllers\MasterData\ProductCategoryController;
use App\Http\Controllers\MasterData\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'access_permission'])->group(function () {

    Route::group(["controller" => CashAccountController::class, "prefix" => "cash_account", "as" => "cash_account."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => PriceLevelController::class, "prefix" => "price_level", "as" => "price_level."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => BusinessPartnerController::class, "prefix" => "business_partner", "as" => "business_partner."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => ProductCategoryController::class, "prefix" => "product_category", "as" => "product_category."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => ProductController::class, "prefix" => "product", "as" => "product."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
});
