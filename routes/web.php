<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PresesniController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('admin.login');
    Route::post('/prosesloginadmin', [AuthController::class, 'adminVerify'])->name('auth.admin.verify');
});

Route::group(['middleware' => 'auth:dosen'], function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    //Presensi
    Route::get('/presensi', [PresesniController::class, 'presensi'])->name('presensi');
    Route::post('/presensi/store', [PresesniController::class, 'presensiStore'])->name('presensi.store');

    //edit profile
    Route::get('/editprofile', [PresesniController::class, 'editprofile'])->name('editprofile');
    Route::post('/updateprofile', [PresesniController::class, 'updateprofile'])->name('updateprofile');
     
});

Route::group(['middleware' => 'auth:mahasiswa'], function () {
    Route::get('/mahasiswa/home', [DashboardController::class, 'dashboardmahasiswa'])->name('mahasiswa.home');
    Route::get('/mahasiswa/lihatdosen', [MahasiswaController::class, 'index'])->name('mahasiswa.lihatdosen');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin'])->name('admin.logout');
    Route::get('/panel/home', [DashboardController::class, 'dashboardadmin'])->name('admin.home');

    //dosen
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
    Route::post('/dosen/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::post('/dosen/{nidn}/update', [DosenController::class, 'update'])->name('dosen.update');
    Route::post('/dosen/{nidn}/delete', [DosenController::class, 'delete'])->name('dosen.delete');
    });


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
