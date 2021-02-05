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
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OurDogsController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PartyImagesController;
use App\Http\Controllers\RefugeController;
use App\Http\Controllers\RefugeImagesController;
use App\Http\Controllers\DeadController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HuntersGalleryController;
use App\Http\Controllers\HuntersGalleryImageController;
use App\Http\Controllers\TrophyController;
use App\Http\Controllers\TrophyGalleryController;
use App\Http\Controllers\TrophyGalleryImagesController;

Route::get('/', HomeController::class)->name('home');
Route::resource('/main', MainPageController::class)->except(['index', 'show']);
Route::get('/historia', HistoryController::class);
Route::resource('/sztandar', StandardController::class)->except(['show']);
Route::get('/odznaczenia', DecorationController::class);
Route::get('/lowiska', HuntingGroundController::class);
Route::resource('/adres', AddressController::class);

Route::resource('zarzad', ManagementsController::class)->except(['show']);
Route::resource('czlonkowie_kola', MembersController::class)->except(['show']);
Route::resource('membersTitles', MemberTitleController::class)->only(['create', 'store', 'edit', 'update']);
Route::resource('rezydenci', ResidentsController::class)->except(['index', 'show']);
Route::resource('galerie', GalleryController::class);
Route::resource('dziczyzna', VenisonController::class)->except(['show']);
Route::resource('komunikaty', MessageController::class);
Route::resource('psy', OurDogsController::class)->except(['show']);
Route::resource('imprezy', PartyController::class);
Route::resource('ostoja', RefugeController::class);
Route::resource('kraina', DeadController::class);
Route::resource('aktualnosci', NewsController::class)->except(['show']);
Route::resource('galerie-mysliwego', HuntersGalleryController::class);
Route::resource('trofea', TrophyController::class)->except(['show']);
Route::resource('trofea-galeria', TrophyGalleryController::class)->except(['index']);



Route::get('zdjecia-galerii-mysliwego/create/{id}',
  [HuntersGalleryImageController::class, 'create'])->name('zdjecia-galerii-mysliwego.create')->middleware('auth');
Route::post('zdjecia-galerii-mysliwego/store',
  [HuntersGalleryImageController::class, 'store'])->name('zdjecia-galerii-mysliwego.store')->middleware('auth');
Route::get('zdjecia-galerii-mysliwego/{id}/edit',
  [HuntersGalleryImageController::class, 'edit'])->name('zdjecia-galerii-mysliwego.edit')->middleware('auth');
Route::put('zdjecia-galerii-mysliwego/{id}',
  [HuntersGalleryImageController::class, 'update'])->name('zdjecia-galerii-mysliwego.update')->middleware('auth');
Route::delete('zdjecia-galerii-mysliwego/{id}',
  [HuntersGalleryImageController::class, 'destroy'])->name('zdjecia-galerii-mysliwego.destroy')->middleware('auth');




Route::get('zdjecia-galerii-trofea/create/{id}',
  [TrophyGalleryImagesController::class, 'create'])->name('zdjecia-galerii-trofea.create')->middleware('auth');
Route::post('zdjecia-galerii-trofea/store',
  [TrophyGalleryImagesController::class, 'store'])->name('zdjecia-galerii-trofea.store')->middleware('auth');
Route::get('zdjecia-galerii-trofea/{id}/edit',
  [TrophyGalleryImagesController::class, 'edit'])->name('zdjecia-galerii-trofea.edit')->middleware('auth');
Route::put('zdjecia-galerii-trofea/{id}',
  [TrophyGalleryImagesController::class, 'update'])->name('zdjecia-galerii-trofea.update')->middleware('auth');
Route::delete('zdjecia-galerii-trofea/{id}',
  [TrophyGalleryImagesController::class, 'destroy'])->name('zdjecia-galerii-trofea.destroy')->middleware('auth');




Route::get('/ostoja_zdjecia/create/{id}', [RefugeImagesController::class, 'create'])->name('ostoja_zdjecia.create')->middleware('auth');
Route::post('/ostoja_zdjecia/store', [RefugeImagesController::class, 'store'])->name('ostoja_zdjecia.store')->middleware('auth');
Route::get('/ostoja_zdjecia/{id}/edit', [RefugeImagesController::class, 'edit'])->name('ostoja_zdjecia.edit')->middleware('auth');
Route::put('/ostoja_zdjecia/{id}', [RefugeImagesController::class, 'update'])->name('ostoja_zdjecia.update')->middleware('auth');
Route::delete('/ostoja_zdjecia/{id}', [RefugeImagesController::class, 'destroy'])->name('ostoja_zdjecia.destroy')->middleware('auth');



Route::get('/imprezy_zdjecia/create/{id}', [PartyImagesController::class, 'create'])->name('imprezy_zdjecia.create')->middleware('auth');
Route::post('/imprezy_zdjecia/store', [PartyImagesController::class, 'store'])->name('imprezy_zdjecia.store')->middleware('auth');
Route::get('/imprezy_zdjecia/{id}/edit', [PartyImagesController::class, 'edit'])->name('imprezy_zdjecia.edit')->middleware('auth');
Route::put('/imprezy_zdjecia/{id}', [PartyImagesController::class, 'update'])->name('imprezy_zdjecia.update')->middleware('auth');
Route::delete('/imprezy_zdjecia/{id}', [PartyImagesController::class, 'destroy'])->name('imprezy_zdjecia.destroy')->middleware('auth');



Route::get('/zdjecia/create/{id}', [ImageController::class, 'create'])->name('zdjecia.create')->middleware('auth');
Route::post('/zdjecia/store', [ImageController::class, 'store'])->name('zdjecia.store')->middleware('auth');
Route::get('/zdjecia/{id}/edit', [ImageController::class, 'edit'])->name('zdjecia.edit')->middleware('auth');
Route::put('/zdjecia/{id}', [ImageController::class, 'update'])->name('zdjecia.update')->middleware('auth');
Route::delete('/zdjecia/{id}', [ImageController::class, 'destroy'])->name('zdjecia.destroy')->middleware('auth');



Route::get('/storage-link', function() {
  $exitCode = Artisan::call('storage:link');
  return 'DONE';
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'cache: cache:clear, config:cache, config:clear, view:clear - wyczyszczony';
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
