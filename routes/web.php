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
use App\Http\Controllers\MemberTitleController;
use App\Http\Controllers\ResidentsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VenisonController;


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
Route::resource('membersTitles', MemberTitleController::class)->only(['create', 'store', 'edit', 'update']);
Route::resource('rezydenci', ResidentsController::class)->except(['index', 'show']);
Route::resource('galerie', GalleryController::class);
Route::resource('dziczyzna', VenisonController::class);


Route::get('/zdjecia/create/{id}', [ImageController::class, 'create'])->name('zdjecia.create');
Route::post('/zdjecia/store', [ImageController::class, 'store'])->name('zdjecia.store');
Route::get('/zdjecia/{id}/edit', [ImageController::class, 'edit'])->name('zdjecia.edit');
Route::put('/zdjecia/{id}', [ImageController::class, 'update'])->name('zdjecia.update');
Route::delete('/zdjecia/{id}', [ImageController::class, 'destroy'])->name('zdjecia.destroy');



Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
