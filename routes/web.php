<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangController;
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


Route::get('/user-login', [UserController::class, 'login_page'])->name('dashboard.login');
Route::post('/user-login', [UserController::class, 'login']);


Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('dashboard.transaksi');
    Route::get('/create-transaksi', [TransaksiController::class, 'create'])->name('dashboard.create-transaksi');
    Route::get('/transaksi/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('dashboard.edit-transaksi');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/barang', [BarangController::class, 'index'])->name('dashboard.barang');
    Route::get('/create-barang', [BarangController::class, 'create'])->name('dashboard.create-barang');
    Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('dashboard.edit-barang');


  
});



