<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\PesananLainnyaController;

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return redirect('/antrian');
    });
    
    Route::get('/auth', [AuthController::class, 'ShowLoginForm']);
    Route::post('/login', [AuthController::class, 'Authenticate']);
    Route::get('/antrian', [AntrianController::class, 'AmbilAntrian']);
    Route::get('/antrian/{jenis_pesanan}', [AntrianController::class, 'OpsiMakan']);
    Route::get('/menu', [MenuController::class, 'Index']);
    Route::get('/menu/{id}', [MenuController::class, 'Detail']);
    Route::get('/keranjang', [KeranjangController::class, 'Index']);
    Route::post('/keranjang/{id}', [KeranjangController::class, 'TambahKeranjang']);
    Route::get('/keranjang/edit/{id}', [KeranjangController::class, 'EditKeranjang']);
    Route::post('/keranjang/update/{id}', [KeranjangController::class, 'UpdateKeranjang']);
    Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'HapusKeranjang']);
    Route::get('/bayar/{opsi}', [KeranjangController::class, 'OpsiPembayaran']);
    Route::get('/pesanan', [App\Http\Controllers\PesananController::class, 'Checkout']);
    Route::get('/pesanan/{id}', [App\Http\Controllers\PesananController::class, 'Detail']);
    Route::post('/rating/{id}', [RatingController::class, 'Store']);
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('/logout', [AuthController::class, 'Logout']);
    Route::get('/dashboard', [DashboardController::class, 'Index']);
    Route::post('/dashboard/filter', [DashboardController::class, 'FilterChart']);
    Route::get('/dashboard/laporan-keuangan', [DashboardController::class, 'Laporan']);
    Route::post('/dashboard/laporan-keuangan/filter', [DashboardController::class, 'FilterData']);
    Route::post('/dashboard/laporan-keuangan/cetak', [DashboardController::class, 'CetakLaporan']);
    Route::get('/dashboard/pesanan/tambah/{id}', [PesananController::class, 'TambahDetailPesanan']);
    Route::post('/dashboard/pesanan/tambah', [PesananController::class, 'StoreDetailPesanan']);
    Route::get('/dashboard/pesanan/edit/{id}', [PesananController::class, 'EditDetailPesanan']);
    Route::put('/dashboard/pesanan/edit/{id}', [PesananController::class, 'UpdateDetailPesanan']);
    Route::delete('/dashboard/pesanan/hapus/{id}', [PesananController::class, 'HapusDetailPesanan']);
    Route::resource('/dashboard/menu', AdminMenuController::class);
    Route::resource('/dashboard/pesanan', PesananController::class);
    Route::resource('/dashboard/pesanan-lainnya', PesananLainnyaController::class);
    Route::resource('/dashboard/pengeluaran', PengeluaranController::class);
    
    Route::get('/resetAntrian', [AntrianController::class, 'ResetAntrian']);
    Route::get('/dashboard/pesanan-{jenis_pesanan}', [DashboardController::class, 'PesananDashboard']);
    Route::get('/dashboard/pesanan/bayar/{id}', [PesananController::class,'BayarPesanan']);
    Route::get('/dashboard/pesanan/selesai/{id}', [PesananController::class,'PesananSelesai']);
    Route::get('/dashboard/rating', [RatingController::class, 'Index']);
});
