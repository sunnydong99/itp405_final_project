<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdolController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DreamGroupController;
use App\Http\Controllers\HomeController;
use App\Models\Idol;
use App\Models\Group;
use App\Models\Company;
use Illuminate\Support\Facades\URL;


if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/idols', [IdolController::class, 'index'])->name('idol.index');
Route::get('/idols/{id}', [IdolController::class, 'show'])->where('id', '[0-9]+')->name('idol.show');

Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
Route::get('/groups/{id}', [GroupController::class, 'show'])->where('id', '[0-9]+')->name('group.show');

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/logout', [AuthController::class, 'logoutRedirect']); // this route gets rid of the "route only supports post error" (tried to handle the exception but it didn't work)

Route::get('/dreamgroups', [DreamGroupController::class, 'index'])->name('dream-group.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'userIndex'])->name('home.user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('fav.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('fav.store'); 
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->where('id', '[0-9]+')->name('fav.destroy'); //needs auth - only this user can access
    
    Route::get('/dreamgroups/create', [DreamGroupController::class, 'create'])->name('dream-group.create');
    Route::post('/dreamgroups', [DreamGroupController::class, 'store'])->name('dream-group.store');
    Route::get('/dreamgroups/{id}/edit', [DreamGroupController::class, 'edit'])->where('id', '[0-9]+')->name('dream-group.edit');
    Route::post('/dreamgroups/{id}', [DreamGroupController::class, 'update'])->where('id', '[0-9]+')->name('dream-group.update');
    Route::delete('/dreamgroups/{id}', [DreamGroupController::class, 'destroy'])->where('id', '[0-9]+')->name('dream-group.destroy');
});
Route::get('/dreamgroups/{id}', [DreamGroupController::class, 'show'])->where('id', '[0-9]+')->name('dream-group.show');


