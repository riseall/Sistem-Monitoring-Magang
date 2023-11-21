<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('auth/google', [ProviderController::class, 'redirect'])->name('googleAuth');
Route::get('auth/google/callback', [ProviderController::class, 'callbackGoogle']);

Route::get('/homes', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('pegawai', function () {
    return Inertia::render('Pegawai/Index');
});

Route::get('home', function () {
    return Inertia::render('App');
});

// Route untuk Tampilan Admin

Route::get('dashboard', function () {
    return Inertia::render('Admin/Dashboard');
});

Route::get('mahasiswa', function () {
    return Inertia::render('Admin/Mahasiswa');
});

Route::get('magang', function () {
    return Inertia::render('Admin/Magang');
});

Route::get('absensi', function () {
    return Inertia::render('Admin/Absensi');
});


// Route untuk Tampilan User

Route::get('user.dashboard', function () {
    return Inertia::render('User/Dashboard');
});

Route::get('user.history', function () {
    return Inertia::render('User/History');
});

Route::get('user.dashboard', function () {
    return Inertia::render('User/Dashboard');
});

require __DIR__ . '/auth.php';