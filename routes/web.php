<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| === simble route ===
|
|   Route::get('/malik/{x?}', function ($x = null) {
|        $full = $x;
|        return view("all")->with("fullname",$full);
|    });
|
*/

Route::get('/', function () {
    return view('home');
});


// route groube controller for ctegoryController

Route::controller(CatsController::class,)->group(function () {

    Route::middleware('auth')->group(function () {

        //show all
        Route::get("cats", "all")->name("allCats");

        //show one
        Route::get("cats/show/{id}", "one")->name("showCat");

        //create
        Route::get("cats/create", "create")->name("createCat");
        Route::post("cats/store", "store")->name("storeCat");

        // update 
        Route::get("cats/edit/{id}", "edit")->name("editCat");
        Route::put("cats/update/{id}", "update")->name("updateCat");

        // delete 
        Route::delete("cats/delete/{id}", "delete")->name("deleteCat");
    });
});


// route groube controller for bookController

Route::controller(BookController::class,)->group(function () {

    Route::middleware('auth')->group(function () {

        //show all
        Route::get("books", "mod")->name("allBooks");

        //show one
        Route::get("books/show/{id}", "one")->name("showBook");

        //create
        Route::get("books/create", "create")->name("createBook");
        Route::post("books/store", "store")->name("storeBook");

        // update 
        Route::get("books/edit/{id}", "edit")->name("editBook");
        Route::put("books/update/{id}", "update")->name("updateBook");

        // delete 
        Route::delete("books/delete/{id}", "delete")->name("deleteBook");
    });
});


// route groube controller for register and login

Route::controller(AuthController::class,)->group(function () {

    // route groube middleware for register and login
    Route::middleware('guest')->group(function () {
        //sign up
        Route::get("signup", "sign_up")->name("signup");
        Route::post("signin", "sign_in")->name("signin");
        //login
        Route::get("loginForm", "login_form")->name("loginForm");
        Route::post("login", "log_in")->name("login");
        // logout
    });
    Route::get('allUsers', 'all_users')->name('Users')->middleware('is_admin', 'auth');
    Route::post("logout", "log_out")->name("logout")->middleware('auth');
});
