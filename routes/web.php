<?php

use Illuminate\Support\Facades\Auth;
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
})->name("welcome");

Route::get("/dashboard", "DashboardController@dashboard")->name("dashboard");
Route::post("/dashboard/inventory", "DashboardController@getItems")->name("inventory");

Route::get("/penjualBahan", function () {
    return view("Penjual.bahan");
})->name("penjualBahan");

Route::get("/penjualDowngrade", function () {
    return view("Penjual.downgrade");
})->name("penjualDowngrade");

Route::get("/tinkerer", function () {
    return view("CraftnDismantle.tinkerer");
})->name("tinkerer");

Route::get("/listDowngrade", function () {
    return view("listDowngrade");
})->name("listDowngrade");

Auth::routes();

Route::get('/home', "HomeController@index")->name('home');
