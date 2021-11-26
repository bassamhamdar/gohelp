<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\OrgProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DonationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::group(['prefix' => 'org'], function() {
        Route::post('/login', [OrgController::class, 'login']);
        Route::post('/register', [OrgController::class, 'register']);
        Route::group(['middleware' => ['jwt.organization']], function() {
            Route::post('/logout', [OrgController::class, 'logout']);
            Route::resource('/org', OrgController::class);
            Route::resource('/orgProfile', OrgProfileController::class);
            Route::resource('/address', AddressController::class);
            Route::resource('/donation', DonationController::class);
            Route::resource('/post', PostController::class);
            Route::resource('/Request', RequestController::class);



    });

});


    Route::group(['prefix' => 'user'], function() {
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/register', [UserController::class, 'register']);
        Route::group(['middleware' => ['jwt.user']], function() {
            Route::post('/logout', [UserController::class, 'logout']);
            Route::resource('/org', OrgController::class);
            Route::resource('/user', UserController::class);
            Route::resource('/Request', RequestController::class);
            Route::resource('/post', PostController::class);
            Route::resource('/donation', DonationController::class);
        
        });
    });

    Route::group(['prefix' => 'admin'], function() {
        Route::post('/login', [AdminController::class, 'login']);
        Route::post('/register', [AdminController::class, 'register']);

        Route::group(['middleware' => ['jwt.admin']], function() {
            Route::post('/logout',[AdminController::class, 'logout']);
            Route::post('/blockuser/{id}',[AdminController::class, 'blockUser']);
            Route::post('/organization/{id}',[AdminController::class, 'organization']);
            Route::resource('/donation', DonationController::class);
            Route::resource('/user', UserController::class);
            Route::resource('/org', OrgController::class);


        });
        
    });

