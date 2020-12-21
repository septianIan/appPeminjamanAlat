<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();
// Route::post('login', 'Auth\LoginController@login');
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');

    //master student
    Route::resource('student', 'Master\StudentController')->except('show');
    Route::get('student/master', 'Master\StudentController@dataTable')->name('master.students');

    //master tool
    Route::resource('tool', 'Master\ToolController')->except('show');
    Route::get('tool/master', 'Master\ToolController@dataTable')->name('master.tools');

    //tool arragement
    Route::prefix('tool')->group(function(){
        Route::resource('arragement', 'Arragement\ToolArragementController');
        Route::get('data/arragement', 'Arragement\ToolArragementController@dataTable')->name('data.toolArragement');
        Route::get('barcode', 'Arragement\ToolArragementController@barcode')->name('arragement.barcode');
    });

    //peminjaman
    Route::resource('peminjaman', 'Peminjaman\PeminjamanController');
    // Route::get('data/tool', 'Peminjaman\PeminjamanController@dataTable')->name('data.tool');
    Route::post('cari/nim', 'Peminjaman\PeminjamanController@cariNim')->name('cari.nim');
    Route::post('checkList/alat', 'Peminjaman\PeminjamanController@pinjamAlat')->name('checkList.alat');

    //data pemijam
    Route::get('peminjam/data', 'Peminjaman\PeminjamanController@dataPeminjam')->name('peminjam.data');
    Route::get('peminjam/edit/{id}', 'Peminjaman\PeminjamanController@peminjamEdit')->name('peminjam.edit');

    Route::post('peminjam/pengembalian/{id}', 'Peminjaman\PeminjamanController@pengembalianTunggal')->name('peminjam.pengembalian');
    Route::delete('peminjam/hapus/alat/{id}', 'Peminjaman\PeminjamanController@deleteAlat')->name('peminjam.hapusAlat');
    Route::get('peminjam/detail/{id}', 'Peminjaman\PeminjamanController@detailPeminjam')->name('peminjam.detail');

    //pengembalian
    Route::post('pengembalian/alat', 'Peminjaman\PeminjamanController@pengembalian')->name('pengembalian.alat');

    //riwayat
    Route::get('riwayat/peminjaman', 'Peminjaman\PeminjamanController@riwayat')->name('riwayat.peminjam');

    //Laporan
    Route::get('laporan', 'Laporan\LaporanController@index')->name('laporan.index');
    Route::post('laporan/between', 'Laporan\LaporanController@laporanBetween')->name('laporan.between');

    //Cetak Barcode
    Route::post('cetak/barcode', 'Arragement\ToolArragementController@cetakBarcode')->name('cetak.barcode');
});