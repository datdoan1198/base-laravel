<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;

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

Route::group(["middleware" => ["api"]], function () {
    /* Auth::start */
    Route::group(["prefix" => "auth"], function () {
        Route::post("login", [AuthController::class, "login"]);
        Route::post("register", [AuthController::class, "register"]);
        Route::post("logout", [AuthController::class, "logout"]);
        Route::get("me", [AuthController::class, "me"])->middleware('adminActive');
    });

    Route::group(["middleware" => ["jwt.auth"]], function () {
        /* Employee */
        Route::group(["prefix" => "employees"], function () {
            Route::get("/", [AdminController::class, "index"]);
            Route::post("/", [AdminController::class, "store"]);
        });
    });
});

