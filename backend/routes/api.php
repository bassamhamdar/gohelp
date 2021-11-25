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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('/org', OrgController::class);
Route::resource('/user', UserController::class);
Route::resource('/orgProfile', OrgProfileController::class);
Route::resource('/address', AddressController::class);
Route::resource('/Request', RequestController::class);
Route::resource('/post', PostController::class);


Route::post('/admin/blockuser/{id}',[AdminController::class, 'blockUser']);
Route::post('/admin/organization/{id}',[AdminController::class, 'organization']);