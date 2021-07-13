<?php

use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TestController;
use App\Http\Livewire\Dashboard\Artikel\ArtikelCreate;
use App\Http\Livewire\Dashboard\Artikel\ArtikelIndex;
use App\Http\Livewire\Dashboard\Kategori\KategoriIndex;
use App\Http\Livewire\Dashboard\Komentar\KomentarIndex;
use App\Http\Livewire\Dashboard\User\UserIndex;
use App\Http\Livewire\Dashboard\User\UserPodcaster;
use App\Http\Livewire\Dashboard\User\UserWriter;
use App\Http\Livewire\Dashboard\Welcome;
use App\Http\Livewire\Show\Artikel\ArtikelView;
use App\Models\Artikel;
use GuzzleHttp\Middleware;

// AUTENTIKASI
// ----------------------------------------------------------------------
Route::get('/', function(){ return view('auth');})->name('guest');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

Route::get('/login', [GoogleController::class, 'login'])->name('login');
Route::get('/callback', [GoogleController::class, 'callback']);
// -----------------------------------------------------------------------

Route::middleware(['auth','team'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // Welcome
        Route::get('/',Welcome::class)->name('welcome');
        // User
        Route::get('/user', UserIndex::class)->name('user-index');
        Route::get('/user/writer', UserWriter::class)->middleware('can:admin-only')->name('user-writer');
        Route::get('/user/podcaster', UserPodcaster::class)->middleware('can:admin-only')->name('user-podcaster');
        // Artikel
        Route::get('/artikel', ArtikelIndex::class)->name('artikel-index');
        Route::resource('/artikels', ArtikelController::class)->only(['show','create','store','edit','update']);
        Route::get('/artikels/ubah-status/{artikel}', [ArtikelController::class, 'ubahStatus'])->name('artikel-ubah-status');
        // Kategori
        Route::get('/kategori', KategoriIndex::class)->name('kategori-index');
        // Komentar
        Route::get('/komentar', KomentarIndex::class)->name('komentar-index');

    });
});
Route::get('/artikel', function(){
    $artikels = Artikel::where('is_active', true)->get();
    return view('controller.test.artikel-index', compact('artikels'));
})->name('index-artikel');
Route::get('/{slug}', ArtikelView::class)->name('show-artikel');

