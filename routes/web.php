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
    return view('auth.login');
})->name("welcome");

// Player
Route::get("/dashboard", "DashboardController@dashboard")->name("dashboard");
Route::post("/dashboard/inventory", "DashboardController@getItems")->name("inventory");

Route::get("/listDowngrade", "ListDowngradeController@listDowngrade")->name("listDowngrade");
Route::post("/listDowngrade/alat", "ListDowngradeController@changeAlat")->name("listDowngrade.alat");

Route::get("/hint", function(){
    return view("hint");
})->name("hint");

// Admin Bahan
Route::get("/penjualBahan", "PenjualController@penjualBahan")->name("penjualBahan");
Route::post("/penjualBahan/jual", "PenjualController@jualBahan")->name("jualBahan");

// Admin Downgrade
Route::get("/penjualDowngrade", function () {
    return view("Penjual.downgrade");
})->name("penjualDowngrade");

// Admin Tinkerer
Route::get("/tinkerer", "TinkererController@tinkerer")->name("tinkerer");
Route::post("/tinkerer/alat", "TinkererController@changeAlat")->name("change.alat");
Route::post("/tinkerer/downgrade", "TinkererController@changeDowngrade")->name("change.downgrade");
Route::post("/tinkerer/crafting", "TinkererController@crafting")->name("tinkerer.crafting");
Route::post("/tinkerer/dismantle", "TinkererController@dismantle")->name("tinkerer.dismantle");

// Middleware
Auth::routes();

Route::get('/home', "HomeController@index")->name('home');
