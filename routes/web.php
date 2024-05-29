<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SpotifyController::class,'landingPage'])->name('landingPage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('getPubToken',[SpotifyController::class,'getGlobalTrends'])->name('spotify.getpubtoken');
Route::get('spotifyLogin',[SpotifyController::class, 'login'])->name('spotify.login');
Route::get('spotifyProfile', [SpotifyController::class, 'getUser'])->name('spotify.profile');
Route::get('spotifyAuthorize', [SpotifyController::class, 'authorize'])->name('spotify.authorize');

//Search
Route::get('search',[SearchController::class,'index'])->name('search.index');

Route::get('track/{track}',[TrackController::class,'show'])->name('track.show');
Route::post('track/{track}/addReview',[ReviewController::class,'store'])->name('track.addreview')->middleware(['auth']);

Route::get('album/{album}',[AlbumController::class,'show'])->name('album.show');
require __DIR__.'/auth.php';
