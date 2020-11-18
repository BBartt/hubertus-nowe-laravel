<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\StandardController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\HuntingGroundController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ManagementsController;
use App\Http\Controllers\MembersController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', HomeController::class);
Route::get('/historia', HistoryController::class);
Route::get('/sztandar', StandardController::class);
Route::get('/odznaczenia', DecorationController::class);
Route::get('/lowiska', HuntingGroundController::class);
Route::get('/adres', AddressController::class);

Route::resource('zarzad', ManagementsController::class)->except(['show']);
Route::resource('czlonkowie_kola', MembersController::class)->except(['show']);

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
