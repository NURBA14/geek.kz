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



Route::get("/", "PostController@index")->name("home");

Route::get("/tags", "TagController@index")->name("user.tag.list");
Route::get("/categories", "CategoryController@index")->name("user.category.list");

Route::get("/article/{slug}", "PostController@show")->name("posts.single");
Route::get("/category/{slug}", "CategoryController@show")->name("categories.single");
Route::get("/tag/{slug}", "TagController@show")->name("tag.single");
Route::get("/posts/search", "PostController@search")->name("posts.search");



Route::group(["middleware" => "admin", "prefix" => "admin", "namespace" => "Admin"], function () {
    Route::get("/", "MainController@index")->name("admin.index");
    Route::get("/profile", "UserController@profile")->name("admin.profile");
    Route::post("/profile", "UserController@store")->name("admin.store");

    Route::get("/admins", "UserController@admins")->name("users.admins.table");
    Route::post("/admins/{id}", "UserController@delete")->name("users.admins.delete");

    Route::get("/users", "UserController@users")->name("users.users.table");
    Route::post("/users/{id}", "UserController@add_admin")->name("users.users.admin");

    Route::get("/comments", "CommentController@index")->name("comments.table");
    Route::post("/comments/{id}/delete", "CommentController@delete")->name("comments.delete");

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

    Route::get("/user/profile", "UserController@profile")->name("user.profile");
    Route::get("/user/profile/edit", "UserController@edit")->name("user.profile.edit");
    Route::post("/user/profile/edit", "UserController@update")->name("user.profile.store");

    Route::post("/comment/{post_id}", "CommentController@store")->name("comment.store");
    Route::post("/comment/{id}/delete", "CommentController@delete")->name("comment.delete");
});