<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/', [ProductsController::class, 'products'] );

// add product and save product
Route::get('/add-product', [ProductsController::class, 'addProduct']);
Route::post('/save-product', [ProductsController::class, 'saveProduct']);

// get id then edit | update
Route::get('/edit-product/{id}', [ProductsController::class, 'editProduct']);
Route::put('/update-product/{id}', [ProductsController::class, 'updateProduct']);

// deletions
Route::get('/delete-product/{id}', [ProductsController::class, 'deleteProduct']);
Route::get('/delete-small-image/{id}', [ProductsController::class, 'deleteSmallImages']);
Route::delete('/delete-cover/{id}', [ProductsController::class, 'deleteCover']);