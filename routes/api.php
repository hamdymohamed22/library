<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiCatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ApiCatController::class)->group(function () {

    // show all categories 
    Route::get('categories', "all");
    // show one category 
    Route::get('categories/show/{id}', "show");

    // middleware 
    Route::middleware('api_auth')->group(function () {
        // create category 
        Route::post('category/create', "create");
        // update category 
        Route::put('category/update', "update");
        // update category 
        Route::delete('category/delete', "delete");
        // logout
        Route::post('logout', [ApiAuthController::class, "logout"]);
    });
});
Route::controller(ApiAuthController::class)->group(function () {
    // register
    Route::post('register', "register");
    // login
    Route::post('login', "login");
});
