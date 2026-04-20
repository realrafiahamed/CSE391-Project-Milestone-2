<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

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
    $locations = DB::table('routes')
        ->select('from_location')
        ->distinct()
        ->pluck('from_location')
        ->toArray();

        if (!in_array('Campus (Badda)', $locations)) {
        $locations[] = 'Campus (Badda)';
    }
    return view('dashboard', compact('locations'));
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

Route::get('/buses', [BusController::class, 'index']);
Route::get('/buses/search', [BusController::class, 'search'])->name('buses.search');
Route::get('/seat-layout/{id}', [BusController::class, 'seatLayout'])->name('seat.layout');
Route::post('/book-seat', [BusController::class, 'bookSeat'])->name('seats.book');
Route::get('/ticket/{id}', [BusController::class, 'ticket'])->name('ticket.view');
Route::get('/my-tickets', [BusController::class, 'myTickets'])->name('tickets.index');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout']);

Route::middleware('admin')->group(function () {
    //dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    //buses
    Route::get('/admin/buses', [AdminController::class, 'buses']);
    Route::post('/admin/buses', [AdminController::class, 'storeBus']);
    //routes
    Route::get('/admin/routes', [AdminController::class, 'routes']);
    Route::post('/admin/routes', [AdminController::class, 'storeRoute']);
    //schedules
    Route::get('/admin/schedules', [AdminController::class, 'schedules']);
    Route::post('/admin/schedules', [AdminController::class, 'storeSchedule']);
    //announcements
    Route::get('/admin/announcements', [AdminController::class, 'announcementForm']);
    Route::post('/admin/announcements/send', [AdminController::class, 'sendAnnouncement']);
});