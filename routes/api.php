<?php

use App\Http\Controllers\Api\frontend\CheckoutController;
use App\Http\Controllers\Api\frontend\DashboardController;
use App\Http\Controllers\Api\frontend\FrontEndController;
use App\Http\Controllers\Api\frontend\GuestCheckoutController;
use App\Http\Controllers\Api\frontend\MessagesController;
use App\Http\Controllers\Api\frontend\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['api']], function () {
    // Code Here ..
});
