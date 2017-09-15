
<?php

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

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
  Route::group(['middleware' => 'active'], function(){
    Route::get('/', function(){
      return redirect('gudang/stok');;
    });
    Route::get('gudang', function(){
      return redirect('gudang/stok');;
    });
    Route::resource('gudang/stok','GudangController');
    Route::resource('gudang/gabah','GabahController');
    Route::resource('gudang/jemurgabah','JemurgabahController');
    Route::resource('gudang/giling','GilingController');
    Route::resource('gudang/beras','BerasController');
    Route::resource('gudang/beliberas','BerasbeliController');
    Route::resource('gudang/sekam','SekamController');
    Route::get('gudang/sekam/count/{id}','SekamController@count');
    Route::resource('gudang/dedak','DedakController');
    Route::resource('penjualan','PenjualanController');
    Route::resource('pengeluaran','PengeluaranController');
    Route::get('penjualan/barang/{tipe}','PenjualanController@barang');
    Route::resource('kepegawaian/pegawai','PegawaiController');
    Route::resource('kepegawaian/absen','AbsenController');
    Route::get('kepegawaian/absen/absensi/{id}','KehadiranController@index');
    Route::post('kepegawaian/absen/absensi/{absen}/set/{id}/{tipe}','KehadiranController@absen');
    Route::get('kepegawaian/absen/absensi/{absen}/{id}/edit','KehadiranController@edit');
    Route::put('kepegawaian/absen/absensi/{absen}/{id}/edit','KehadiranController@update');
    Route::resource('kepegawaian/penggajian','PenggajianController');
    Route::get('kepegawaian/penggajian/bulan/{bulan}/tahun/{tahun}','PenggajianController@penggajian');
    Route::get('kepegawaian/penggajian/detail/bulan/{bulan}/tahun/{tahun}/pegawai/{pegawai}/{gaji?}','PenggajianController@detailgaji');
    Route::get('kepegawaian/gaji','GajiController@getGaji');
    Route::post('kepegawaian/gaji','GajiController@setGaji');
    Route::get('kepegawaian/penggajian/proses/bulan/{bulan}/tahun/{tahun}','GajiController@prosesGaji');
    Route::get('generate/slipgaji/{bulan}/{tahun}','GeneratePDFController@generateSlipGaji');
    Route::resource('/profile','ProfileController');
    Route::get('/laporan/harian','LaporanController@harian');
    Route::get('laporan/data','LaporanController@data');
    Route::get('laporan/data/{tangal_mulai}/{tanggal_selesai}','LaporanController@getData');
    Route::group(['middleware' => 'level:1'],function(){
      Route::resource('/users','UsersmanagementController');
      Route::get('users/{id}/change','UsersmanagementController@setStatus');
    });
    Route::resource('/pengaturan','PengaturanController');
});

});
