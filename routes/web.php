<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("home");



Route::group(["middleware" => "admin", "prefix" => "admin", "namespace" => "Admin"], function () {
    Route::get("/", "MainController@index")->name("admin.index");
    Route::resource("/categories", "CategoryController");
    Route::resource("/tags", "TagController");
    Route::resource("/posts", "PostController");
});

Route::group(["middleware" => "guest"], function () {
    Route::get("/register", "User\RegController@create")->name("register.create");
    Route::post("/register", "User\RegController@store")->name("register.store");

    Route::get("/login", "User\LoginController@create")->name("login.create");
    Route::post("/login", "User\LoginController@store")->name("login.store");
});

Route::group(["middleware" => "auth"], function () {
    Route::get("/logout", "User\LoginController@logout")->name("login.logout");
});