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

Route::get("/hint", function () {
    return view("hint");
})->name("hint");

Route::get("/history", "HistoryController@history")->name("history");

// Admin Ingredients
Route::get("/ingredients", "IngredientsController@ingredients")->name("ingredients");
Route::post("/ingredients/add", "IngredientsController@addIngredients")->name("addIngredients");

// Admin Tools
Route::get("/tools", "ToolsController@tools")->name("tools");
Route::post("/tools/add", "ToolsController@addTools")->name("addTools");

// Admin Bahan
// Admin Jual, Pemain Beli
Route::get("/penjualBahanSell", "PenjualController@penjualBahanSell")->name("penjualBahanSell");
Route::post("/penjualBahan/jual", "PenjualController@jualBahan")->name("adminBahanSell");

// Admin Beli, Pemain Jual
Route::get("/penjualBahanBuy", "PenjualController@penjualBahanBuy")->name("penjualBahanBuy");
Route::post("/penjualBahan/beli", "PenjualController@beliBahan")->name("adminBahanBuy");


// Admin Downgrade
// Admin Jual, Pemain Beli
Route::get("/penjualDowngradeSell", "PenjualController@penjualDowngradeSell")->name("penjualDowngradeSell");
Route::post("/penjualDowngrade/jual", "PenjualController@jualDowngrade")->name("adminDowngradeSell");

// Admin beli, Pemain Jual
Route::get("/penjualDowngradeBuy", "PenjualController@penjualDowngradeBuy")->name("penjualDowngradeBuy");
Route::post("/penjualDowngrade/beli", "PenjualController@beliDowngrade")->name("adminDowngradeBuy");


// Admin Tinkerer
Route::get("/tinkerer", "TinkererController@tinkerer")->name("tinkerer");
Route::post("/tinkerer/alat", "TinkererController@changeAlat")->name("change.alat");
Route::post("/tinkerer/downgrade", "TinkererController@changeDowngrade")->name("change.downgrade");
Route::post("/tinkerer/crafting", "TinkererController@crafting")->name("tinkerer.crafting");
Route::post("/tinkerer/dismantle", "TinkererController@dismantle")->name("tinkerer.dismantle");

// addKoin
// Untuk Pos Consultant, Bonus (Sementara)
Route::get("addKoin", "DashboardController@koin")->name("koin");
Route::post("addKoin/koin", "DashboardController@addKoin")->name("addKoin");

// Sesi
Route::get("/adminSesi", "SesiController@sesi")->name("sesi");
Route::post("/adminSesi/ganti", "SesiController@gantiSesi")->name("gantiSesi");

// Middleware
Auth::routes();

Route::get('/home', "HomeController@index")->name('home');
Route::get('/downtes', function () {
    return view('downgradetes');
})->name('downgradeTes');
