<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\UserController;
use App\Models\Presensi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage');
})->name('homepage');



Route::get('/test-db-connection', function () {
    try {
        DB::connection()->getPdo();
        return "connected succesfully";
    }
    catch(\Exception $ex)
    {
        dd($ex->getMessage());
    }
});


Route::apiResource('user', UserController::class);
Route::apiResource('pegawai', PegawaiController::class);
Route::apiResource('presensi', PresensiController::class);


Route::get('/presensi', function () {
    return view('presensi');
})->name('presensi');

Route::get('/presensi-masuk', function () {
    return view('presensi-masuk');
})->name('presensi-masuk');



Route::get('/presensi-pulang', function () {
    return view('presensi-pulang');
})->name('presensi-pulang');


Route::get('/login', function () {
    return view('dashboard.login');
})->name('dashboard.login');



Route::get('/dashboard', function () {
    return view('/dashboard/index');
});


Route::get('/index', function () {
    return view('dashboard.index');
})->name('dashboard.index');


Route::get('/user-login', [UserController::class, 'login_page'])->name('dashboard.login');
Route::post('/user-login', [UserController::class, 'login']);


Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [PegawaiController::class, 'index'])->name('dashboard.transaksi');
    Route::get('/create-pegawai', [PegawaiController::class, 'create'])->name('dashboard.create-pegawai');
    Route::get('/transaksi/{transaksi}/edit', [PegawaiController::class, 'edit'])->name('dashboard.edit-pegawai');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/barang', [PresensiController::class, 'index'])->name('dashboard.barang');
    Route::get('/create-barang', [PresensiController::class, 'create'])->name('dashboard.create-barang');
    Route::get('/barang/{barang}/edit', [PresensiController::class, 'edit'])->name('dashboard.edit-barang');


  
});



