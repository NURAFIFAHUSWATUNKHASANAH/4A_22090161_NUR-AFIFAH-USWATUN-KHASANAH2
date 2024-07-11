<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DaftarPegawaiController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\SosmedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route setelah login berdasarkan role
Route::get('/admin', [AdminController::class, 'index'])->name('admin.home')->middleware(['auth', 'admin']);
Route::get('/user', [UserController::class, 'index'])->name('user.home')->middleware(['auth', 'user']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/auth/google', [SosmedController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [SosmedController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [SosmedController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [SosmedController::class, 'handleFacebookCallback']);

Route::get('/select-role', [RoleController::class, 'selectRole'])->name('select-role');
Route::post('/select-role', [RoleController::class, 'storeRole'])->name('store-role');

Route::get('/verify-email', [RegisterController::class, 'verificationEmail']);

Route::get('/lupa-password', [ResetPasswordController::class, 'lupa_password'])->name('lupa-password');
Route::post('/lupa-password-act', [ResetPasswordController::class, 'lupa_password_act'])->name('lupa-password-act');

Route::get('/validasi-lupa-password/{token}/{email}', [ResetPasswordController::class, 'validasi_lupa_password'])->name('validasi-lupa-password');
Route::post('/validasi-lupa-password-act/{email}', [ResetPasswordController::class, 'validasi_lupa_password_act'])->name('validasi-lupa-password-act');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/user/dashboard', 'UserController@dashboard')->name('user.dashboard');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth', 'admin']);

Route::resource('daftar_pegawai', DaftarPegawaiController::class)->except(['show']);

Route::middleware('auth')->group(function () {
    Route::resource('daftar_pegawai', DaftarPegawaiController::class);
    Route::put('/daftar_pegawai/{id}', [DaftarPegawaiController::class, 'update'])->name('daftar_pegawai.update');


    // Route untuk alternatif yang bisa diakses oleh admin dan user
    Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
    Route::group(['middleware' => ['admin']], function () {
        Route::resource('alternatif', AlternatifController::class)->except('index');
        Route::resource('kriteria', KriteriaController::class);
        // Tambahkan rute lain yang hanya boleh diakses oleh admin
    });
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
});


Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');
Route::get('/topsis/ranking', [TopsisController::class, 'ranking'])->name('topsis.ranking');

// Rute untuk admin
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

// Rute untuk pengguna biasa
Route::get('/user/dashboard', 'UserController@dashboard')->name('user.dashboard');

Route::get('/users', 'UserController@index')->name('user.dashboard');
Route::get('/users', 'App\Http\Controllers\UserController@index');




Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::resource('alternatif', AlternatifController::class)->except('index');

Route::get('/profile', 'ProfileController@show')->name('profile.show');

Route::get('/app', function () {
    return view('layouts.app');
})->name('app');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::get('/search', [DaftarPegawaiController::class, 'search'])->name('search');

Route::put('/daftar_pegawai/{id}', [DaftarPegawaiController::class, 'update'])->name('daftar_pegawai.update');
Route::get('/topsis/chart', [TopsisController::class, 'chart'])->name('topsis.chart');


Route::get('/topsis-results', [TopsisController::class, 'showResults']);
Route::get('/topsis/rankings', [TopsisController::class, 'rankings'])->name('topsis.rankings');
Route::get('/topsis/ranking', [TopsisController::class, 'showRanking'])->name('topsis.ranking');
Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');
Route::get('/topsis/ranking', [TopsisController::class, 'ranking'])->name('topsis.ranking');