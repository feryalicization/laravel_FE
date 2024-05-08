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


// Route::get('/charts', function () {
//     return view('dashboard.charts');
// })->name('dashboard.charts');

Route::get('/user-login', [UserController::class, 'login_page'])->name('dashboard.login');
Route::post('/user-login', [UserController::class, 'login']);

Route::get('/qrcode-absen', [PresensiController::class, 'qrcode_absen']);

Route::post('/generate-qrcode-masuk', [PresensiController::class, 'qrcodeGenerator'])->name('presensi.qrcodeGenerator');
Route::post('/generate-qrcode-keluar', [PresensiController::class, 'qrcodeGenerator_keluar'])->name('presensi.qrcodeGenerator-keluar');

Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [PegawaiController::class, 'index'])->name('dashboard.kelola-pegawai');
    Route::get('/create-pegawai', [PegawaiController::class, 'create'])->name('dashboard.create-pegawai');
    Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('dashboard.edit-pegawai');
    Route::get('/qrcode-pegawai', [PegawaiController::class, 'create_qrcode'])->name('dashboard.qrcode-pegawai');
    Route::post('/store-qrcode', [PegawaiController::class, 'store_qrcode'])->name('pegawai.store_qrcode');
    Route::get('/create-user', [UserController::class, 'create'])->name('dashboard.create-user');
    Route::get('/user-profile', [UserController::class, 'show'])->name('dashboard.index');
    Route::post('/update-password', [UserController::class, 'update'])->name('update.password');
    Route::get('/edit-password/{user}', [UserController::class, 'edit'])->name('edit.password');
    Route::post('/update-profile', [UserController::class, 'update_profile'])->name('update.profile');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/barang', [PresensiController::class, 'index'])->name('dashboard.data-presensi');
    Route::get('/data-laporan-presensi', [PresensiController::class, 'laporan_presensi'])->name('dashboard.data-laporan-presensi');

    Route::post('/generate-qrcode', [UserController::class, 'qrcodeGenerator'])->name('user.qrcodeGenerator');
  
});



