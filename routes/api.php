<?php

use App\Http\Controllers\Pages\PrivacyPolicyController;
use App\Http\Controllers\PopupsController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('locale')->group(function (){

    Route::get('/privacy', [PrivacyPolicyController::class, 'privacy']);

    Route::post('/request', [PopupsController::class, 'request_popup_post']);

});
