<?php

use App\Http\Controllers\AuthControllers\AuthChangePassword;
use App\Http\Controllers\AuthControllers\AuthConfirmCode;
use App\Http\Controllers\AuthControllers\AuthForgetPassword;
use App\Http\Controllers\AuthControllers\AuthLogin;
use App\Http\Controllers\AuthControllers\AuthLogout;
use App\Http\Controllers\AuthControllers\AuthSendCode;
use App\Http\Controllers\CategoryControllers\CategoryById;
use App\Http\Controllers\CategoryControllers\CategoryDelete;
use App\Http\Controllers\CategoryControllers\CategoryList;
use App\Http\Controllers\CategoryControllers\CategoryStore;
use App\Http\Controllers\CategoryControllers\CategoryUpdate;
use App\Http\Controllers\OrderControllers\OrderById;
use App\Http\Controllers\OrderControllers\OrderDelete;
use App\Http\Controllers\OrderControllers\OrderList;
use App\Http\Controllers\OrderControllers\OrderStore;
use App\Http\Controllers\ProductControllers\ProductById;
use App\Http\Controllers\ProductControllers\ProductDelete;
use App\Http\Controllers\ProductControllers\ProductList;
use App\Http\Controllers\ProductControllers\ProductStore;
use App\Http\Controllers\ProductControllers\ProductUpdate;
use App\Http\Controllers\ServiceControllers\ServiceById;
use App\Http\Controllers\ServiceControllers\ServiceDelete;
use App\Http\Controllers\ServiceControllers\ServiceList;
use App\Http\Controllers\ServiceControllers\ServiceStore;
use App\Http\Controllers\ServiceControllers\ServiceUpdate;
use App\Http\Controllers\UserControllers\UserById;
use App\Http\Controllers\UserControllers\UserDelete;
use App\Http\Controllers\UserControllers\UserList;
use App\Http\Controllers\UserControllers\UserStore;
use App\Http\Controllers\UserControllers\UserUpdate;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthLogin::class, 'login']);
Route::post('/forget-password', [AuthForgetPassword::class, 'forgetPassword']);
Route::post('/change-password', [AuthChangePassword::class, 'changePassword']);
Route::post('/send-code', [AuthSendCode::class, 'sendCode']);
Route::post('/confirm-code', [AuthConfirmCode::class, 'confirmCode']);
Route::post('/users', [UserStore::class, 'store']);

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'auth'], function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserList::class, 'list']);
        Route::get('/{user}', [UserById::class, 'byId']);
        Route::post('/', [UserStore::class, 'store']);
        Route::post('/{user}', [UserUpdate::class, 'update']);
        Route::delete('/delete/{user}', [UserDelete::class, 'delete']);
        Route::post('/logout', [AuthLogout::class, 'logout']);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductList::class, 'list']);
        Route::get('/{product}', [ProductById::class, 'byId']);
        Route::post('/', [ProductStore::class, 'store']);
        Route::post('/{product}', [ProductUpdate::class, 'update']);
        Route::delete('/delete/{product}', [ProductDelete::class, 'delete']);
    });

    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceList::class, 'list']);
        Route::get('/{service}', [ServiceById::class, 'byId']);
        Route::post('/', [ServiceStore::class, 'store']);
        Route::post('/{service}', [ServiceUpdate::class, 'update']);
        Route::delete('/delete/{service}', [ServiceDelete::class, 'delete']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryList::class, 'list']);
        Route::get('/{category}', [CategoryById::class, 'byId']);
        Route::post('/', [CategoryStore::class, 'store']);
        Route::post('/{category}', [CategoryUpdate::class, 'update']);
        Route::delete('/delete/{category}', [CategoryDelete::class, 'delete']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderList::class, 'list']);
        Route::get('/{order}', [OrderById::class, 'byId']);
        Route::post('/', [OrderStore::class, 'store']);
        Route::delete('/delete/{order}', [OrderDelete::class, 'delete']);
    });
});
