<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login'); // show login form
    Route::post('/login', [AuthenticatedSessionController::class, 'store']); // handle login
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // show register form
    Route::post('/register', [RegisteredUserController::class, 'store']); // handle registration
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/password', function () {
        return view('profile.change-password');})->name('password.change');
    Route::put('/user/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/profile/delete', function () {
        return view('profile.delete-profile');})->name('profile.delete.page');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])
        ->name('profile.delete');
});