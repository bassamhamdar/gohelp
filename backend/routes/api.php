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
            Route::get('/profile/{id}', [OrgController::class, 'show']);
            Route::get('/all/donations/{id}', [PostController::class, 'DonationsOnPosts']);
            Route::get('/helpRequests/{id}',  [RequestController::class, 'helpRequests']);
            Route::get('/donationRequests/{id}',  [RequestController::class, 'donationRequests']);
            Route::post('/donation/accept/{id}', [PostController::class,'acceptDonation']);
            Route::get('/donation/{id}', [PostController::class,'donationOnSpecificPost']);
            Route::resource('/org', OrgController::class);
            Route::post('/accept/request/{id}', [RequestController::class, 'acceptRequests']);
            Route::post('/logout', [OrgController::class, 'logout']);
            Route::post('/post', [PostController::class, 'store']);
            Route::put('/post/{id}', [PostController::class, 'update']);
            Route::get('/post', [PostController::class, 'index']);
            



    });

});



    Route::group(['prefix' => 'user'], function() {
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/register', [UserController::class, 'register']);
        Route::group(['middleware' => ['jwt.user']], function() {
            Route::post('/logout', [UserController::class, 'logout']);
            Route::get('/org', [OrgController::class, 'index']);
            Route::get('/org/profile/{id}', [OrgProfileController::class, 'show']);
            Route::get('/posts', [PostController::class, 'index']);
            Route::post('/donate', [DonationController::class, 'store']);
            Route::post('/request',[RequestController::class, 'store']);
            Route::put('/profile/{id}', [UserController::class,'update']);
        
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

