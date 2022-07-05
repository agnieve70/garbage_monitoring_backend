<?php

use App\Http\Controllers\Api\GarbageController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MrfController;
use App\Http\Controllers\Api\RegisterController;
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
Route::post("register", [ RegisterController::class, "index"]);
Route::post("login", [ LoginController::class, "index"]);

Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::get("mrf", [ MrfController::class, "index"]);
    Route::get("mrf/{id}", [ MrfController::class, "getMrf"]);
    Route::post("mrf/create", [ MrfController::class, "create"]);

    Route::get("garbages", [ GarbageController::class, "index"]);
    Route::get("garbages/total/{type}", [ GarbageController::class, "getGarbageTotalType"]);
    Route::get("garbages/type/{type}", [ GarbageController::class, "getGarbageType"]);
    Route::get("garbage/{id}", [ GarbageController::class, "getGarbage"]);
    Route::post("garbage/create", [ GarbageController::class, "create"]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
