<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('spotifyLogin',[SpotifyController::class, 'login'])->name('spotify.login');
Route::get('spotifyProfile', [SpotifyController::class, 'getUser'])->name('spotify.profile');
Route::get('spotifyAuthorize', [SpotifyController::class, 'authorize'])->name('spotify.authorize');


require __DIR__.'/auth.php';
