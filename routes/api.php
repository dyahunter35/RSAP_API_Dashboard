<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [\App\Http\Controllers\api\UserController::class, 'login']);;

Route::middleware(["auth:sanctum", 'verified'])->group(function () {
    Route::get('me', function (Request $request) {
        return $request->user();
    });

    Route::get('logout', [\App\Http\Controllers\api\UserController::class, 'logout']);
});
Route::get('patient/{key}', [\App\Http\Controllers\api\ApiPatientsController::class, 'search']);

Route::get('string', function () {
    return ['string' => 'test is done'];
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
// });
