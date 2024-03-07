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


Route::group(["middleware" => ["admin", "ban"], "prefix" => "admin", "namespace" => "Admin"], function () {
    //-----------------------------Middle
    Route::get("/", "MainController@index")->name("admin.index");
    Route::get("/profile", "UserController@profile")->name("admin.profile");
    Route::post("/profile", "UserController@store")->name("admin.store");

    //----------------------------Admins edit
    Route::get("/admins", "UserController@admins")->name("users.admins.table");
    Route::get("/admins/list/search", "SearchController@admins")->name("user.admins.search");
    Route::post("/admins/{id}", "UserController@delete")->name("users.admins.delete");

    //----------------------------Users edit
    Route::get("/users", "UserController@users")->name("users.users.table");
    Route::get("/users/list/search", "SearchController@users")->name("user.users.search");
    Route::post("/users/{id}", "UserController@add_admin")->name("users.users.admin");
    Route::get("/user/bridge/{id}", "UserController@bridge")->name("users.users.bridge");

    //----------------------------Comments edit
    Route::get("/comments", "CommentController@index")->name("comments.table");
    Route::get("/comments/list/search", "SearchController@comments")->name("comments.search");
    Route::post("/comments/{id}/delete", "CommentController@delete")->name("comments.delete");

    //----------------------------Banned Users edit
    Route::get("/banned/users/list", "UserController@banned_list")->name("users.banned.list");
    Route::get("/banned/users/search", "SearchController@banned")->name("users.banned.search");
    Route::post("/user/unban/{id}", "UserController@unbanned")->name("user.users.unban");
    Route::post("/user/ban/{id}", "UserController@ban")->name("user.users.ban");

    //-----------------------------Categories edit
    Route::resource("/categories", "CategoryController");
    Route::get("/categories/list/search", "SearchController@categories")->name("admin.categories.search");

    //-----------------------------Tags edit
    Route::resource("/tags", "TagController");
    Route::get("/tags/list/search", "SearchController@tags")->name("admin.tags.search");

    //-----------------------------Posts edit
    Route::resource("/posts", "PostController");
    Route::get("/posts/list/search", "SearchController@posts")->name("admin.posts.search");
});


Route::group(["middleware" => "guest"], function () {
    //------------------------------------Reg-in
    Route::get("/register", "User\RegController@create")->name("register.create");
    Route::post("/register", "User\RegController@store")->name("register.store");

    //------------------------------------Login
    Route::get("/login", "User\LoginController@create")->name("login.create");
    Route::post("/login", "User\LoginController@store")->name("login.store");
});


Route::group(["middleware" => ["auth", "ban"]], function () {
    //-------------------------------Logout
    Route::get("/logout", "User\LoginController@logout")->name("login.logout");

    //-------------------------------User-Profile
    Route::get("/user/profile", "UserController@profile")->name("user.profile");
    Route::get("/user/profile/edit", "UserController@edit")->name("user.profile.edit");
    Route::post("/user/profile/edit", "UserController@update")->name("user.profile.store");

    //-------------------------------Comments
    Route::post("/comment/{post_id}", "CommentController@store")->name("comment.store");
    Route::post("/comment/{id}/delete", "CommentController@delete")->name("comment.delete");

    //-------------------------------Send mail
    Route::get("/mail/reg", "Mail\MailController@reg")->name("reg.mail");
});

Route::view('/ban', 'ban')->name("banned");