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

//home
Route::get('/', 'PagesController@home');
//produk kami
Route::get('/produk_kami', 'PagesController@produk');
Route::get('/search_produk_kami','PagesController@searchProduk');
//produk kami 1
Route::get('/produk_kami1', 'PagesController@produk1');
Route::get('/search_produk_kami1','PagesController@searchProduk1');
//Layanan kami
Route::get('/layanan_kami', 'PagesController@layanan');
Route::get('/search_layanan_kami','PagesController@searchLayanan');
//Dashboard
Route::get('/dashboard','PagesController@dashboard');


//harus login dulu biar bisa ngaksesnya
Route::group(['middleware' => ['checkUser']], function(){

    //owner punya
    Route::middleware(['role:1'])->group(function () {
        //layanan
        Route::get('/layanan', 'LayananController@index');
        Route::get('/layanan/create', 'LayananController@create');
        Route::post('/layanan', 'LayananController@store');
        Route::get('/layanan/{layanan}', 'LayananController@show');
        Route::delete('/layanan/{layanan}', 'LayananController@destroy');
        Route::get('/layanan/{layanan}/edit', 'LayananController@edit');
        Route::patch('/layanan/{layanan}', 'LayananController@update');
        Route::get('/search_layanan','LayananController@search');
        
        //produk
        Route::get('/produk', 'ProdukController@index');
        Route::get('/produk/create', 'ProdukController@create');
        Route::post('/produk', 'ProdukController@store');
        Route::get('/produk/{produk}', 'ProdukController@show');
        Route::delete('/produk/{produk}', 'ProdukController@destroy');
        Route::get('/produk/{produk}/edit', 'ProdukController@edit');
        Route::patch('/produk/{produk}', 'ProdukController@update');
        Route::get('/search_produk','ProdukController@search');

        //pegawai dan register
        Route::get('/pegawai', 'PegawaiController@index');
        Route::get('/pegawai/create', 'PegawaiController@create');
        Route::post('/pegawai', 'PegawaiController@store');
        Route::get('/pegawai/{pegawai}', 'PegawaiController@show');
        Route::delete('/pegawai/{pegawai}', 'PegawaiController@destroy');
        Route::get('/pegawai/{pegawai}/edit', 'PegawaiController@edit');
        Route::patch('/pegawai/{pegawai}', 'PegawaiController@update');
        Route::get('/search_pegawai','PegawaiController@search');

        // Route::get('/pegawai/{pegawai}/editPassword', 'PegawaiController@editPassword');
        // Route::patch('/pegawai/{pegawai}', 'PegawaiController@updatePassword');

        // //customer
        // Route::get('/customer', 'CustomerController@index');
        // Route::get('/customer/create', 'CustomerController@create');
        // Route::post('/customer', 'CustomerController@store');
        // Route::get('/customer/{customer}', 'CustomerController@show');
        // Route::delete('/customer/{customer}', 'CustomerController@destroy');
        // Route::get('/customer/{customer}/edit', 'CustomerController@edit');
        // Route::patch('/customer/{customer}', 'CustomerController@update');
        // Route::get('/search_customer','CustomerController@search');

        //supplier
        Route::get('/supplier', 'SupplierController@index');
        Route::get('/supplier/create', 'SupplierController@create');
        Route::post('/supplier', 'SupplierController@store');
        Route::get('/supplier/{supplier}', 'SupplierController@show');
        Route::delete('/supplier/{supplier}', 'SupplierController@destroy');
        Route::get('/supplier/{supplier}/edit', 'SupplierController@edit');
        Route::patch('/supplier/{supplier}', 'SupplierController@update');
        Route::get('/search_supplier','SupplierController@search');

        // //hewan
        // Route::get('/hewan', 'HewanController@index');
        // Route::get('/hewan/create', 'HewanController@create');
        // Route::post('/hewan', 'HewanController@store');
        // Route::get('/hewan/{hewan}', 'HewanController@show');
        // Route::delete('/hewan/{hewan}', 'HewanController@destroy');
        // Route::get('/hewan/{hewan}/edit', 'HewanController@edit');
        // Route::patch('/hewan/{hewan}', 'HewanController@update');
        // Route::get('/search_hewan','HewanController@search');

        //jenis
        Route::get('/jenis', 'JenisController@index');
        Route::get('/jenis/create', 'JenisController@create');
        Route::post('/jenis', 'JenisController@store');
        Route::get('/jenis/{jenis}/destroy', 'JenisController@destroy');
        //Route::get('/jenis/{jenis}', 'JenisController@show');
        Route::get('/jenis/{jenis}/edit', 'JenisController@edit');
        Route::post('/jenis/{jenis}/update', 'JenisController@update');
        Route::get('/search_jenis','JenisController@search');
        
        //ukuran
        Route::get('/ukuran', 'UkuranController@index');
        Route::get('/ukuran/create', 'UkuranController@create');
        Route::post('/ukuran', 'UkuranController@store');
        Route::get('/ukuran/{ukuran}/destroy', 'UkuranController@destroy');
        Route::get('/ukuran/{ukuran}/edit', 'UkuranController@edit');
        Route::post('/ukuran/{ukuran}/update', 'UkuranController@update');
        Route::get('/search_ukuran','UkuranController@search');

        //pengadaan
        Route::get('/pengadaan', 'PengadaanController@index');
        Route::get('/pengadaan/create', 'PengadaanController@create');
        Route::post('/pengadaan', 'PengadaanController@store');
        Route::get('/pengadaan/{pengadaan}', 'PengadaanController@show')->name('ShowDetailPengadaaan');
        Route::delete('/pengadaan/{pengadaan}', 'PengadaanController@destroy');
        Route::get('/pengadaan/{pengadaan}/edit', 'PengadaanController@edit');
        Route::patch('/pengadaan/{pengadaan}', 'PengadaanController@update');
        Route::get('/search_pengadaan','PengadaanController@search');

        //detail pengadaan / pengadaan produk
        Route::get('/pengadaan/{pengadaan}/createProduk', 'PengadaanController@createProduk');
        Route::post('/pengadaan/{pengadaan}', 'PengadaanController@storeProduk');
        Route::get('/pengadaan/{pengadaan}/{detail_pengadaan}/editProduk', 'PengadaanController@editProduk');
        Route::patch('/pengadaan/{pengadaan}/{detail_pengadaan}', 'PengadaanController@updateProduk');
        Route::delete('/pengadaan/{pengadaan}/{detail_pengadaan}', 'PengadaanController@destroyProduk');
        Route::patch('/pengadaan/{pengadaan}', 'PengadaanController@verifikasi')->name('Verifikasi');
        Route::get('/pengadaan/{pengadaan}/pesan', 'PengadaanController@pesan');
        Route::get('/pengadaan/{pengadaan}/cetakStruk', 'PengadaanController@cetakStruk');

        // pengadaan tahunan
        Route::get('/layananTerlaris', 'LaporanController@layananTerlaris');
        Route::get('/produkTerlaris', 'LaporanController@produkTerlaris');
        
        //laporan
        Route::get('/pendapatanBulanan', 'LaporanController@pendapatanBulanan');
        Route::get('/laporan_pengadaan_tahunan', 'LaporanController@laporanPengadaanTahunan');

        // pengadaan tahunan
        Route::get('/pengadaanTahunan', 'LaporanController@laporanPengadaanTahunan');

        //pengadaan  bulanan 
        Route::get('/pengadaanBulanan', 'LaporanController@laporanPengadaanBulanan');
        Route::get('/pengadaanBulanan/pengadaan_bulanan_pdf/{year}/{month}','LaporanController@cetakPengadaanBulanan');

        //notifikasi produk
        Route::get('/notifikasi', 'ProdukController@notifikasiProduk');

    });

    Route::middleware(['role:1,2'])->group(function () {
        //hewan
        Route::get('/hewan', 'HewanController@index');
        Route::get('/hewan/create', 'HewanController@create');
        Route::post('/hewan', 'HewanController@store');
        Route::get('/hewan/{hewan}', 'HewanController@show');
        Route::delete('/hewan/{hewan}', 'HewanController@destroy');
        Route::get('/hewan/{hewan}/edit', 'HewanController@edit');
        Route::patch('/hewan/{hewan}', 'HewanController@update');
        Route::get('/search_hewan','HewanController@search');

        //customer
        Route::get('/customer', 'CustomerController@index');
        Route::get('/customer/create', 'CustomerController@create');
        Route::post('/customer', 'CustomerController@store');
        Route::get('/customer/{customer}', 'CustomerController@show');
        Route::delete('/customer/{customer}', 'CustomerController@destroy');
        Route::get('/customer/{customer}/edit', 'CustomerController@edit');
        Route::patch('/customer/{customer}', 'CustomerController@update');
        Route::get('/search_customer','CustomerController@search');

    });

    Route::middleware(['role:2'])->group(function () {

        //transaksi produk
        Route::get('/transaksi_produk/create', 'TransaksiProdukController@create');
        Route::post('/transaksi_produk', 'TransaksiProdukController@store');
        Route::delete('/transaksi_produk/{transaksi_produk}', 'TransaksiProdukController@destroy');
        Route::get('/transaksi_produk/{transaksi_produk}/edit', 'TransaksiProdukController@edit');
        Route::patch('/transaksi_produk/{transaksi_produk}', 'TransaksiProdukController@update');

        //transaksi layanan
        Route::get('/transaksi_layanan/create', 'TransaksiLayananController@create');
        Route::post('/transaksi_layanan', 'TransaksiLayananController@store');
        Route::delete('/transaksi_layanan/{transaksi_layanan}', 'TransaksiLayananController@destroy');
        Route::get('/transaksi_layanan/{transaksi_layanan}/edit', 'TransaksiLayananController@edit');
        Route::patch('/transaksi_layanan/{transaksi_layanan}', 'TransaksiLayananController@update');
        
        //verifikasi layanan
        Route::post('/transaksi_layanan/{transaksi_layanan}/sms', 'TransaksiLayananController@sendSms');
        // Route::post('/transaksi_layanan/{transaksi_layanan}/sms','TransaksiLayananController@sms');

        
    });

    Route::middleware(['role:2,3'])->group(function () {

        //transaksi dan pembayaran produk
        Route::get('/transaksi_produk', 'TransaksiProdukController@index');
        Route::get('/transaksi_produk/{transaksi_produk}', 'TransaksiProdukController@show')->name('ShowDetailTransaksiProduk');
        Route::get('/search_transaksi_produk','TransaksiProdukController@search');

        Route::get('/transaksi_produk/{transaksi_produk}/cetakStruk', 'TransaksiProdukController@cetakStruk');
        
        //detail transaksi produk dan pembayaran produk
        Route::get('/transaksi_produk/{transaksi_produk}/createProduk', 'TransaksiProdukController@createProduk');
        Route::post('/transaksi_produk/{transaksi_produk}', 'TransaksiProdukController@storeProduk');
        Route::get('/transaksi_produk/{transaksi_produk}/{detail_transaksi_produk}/editProduk', 'TransaksiProdukController@editProduk');
        Route::patch('/transaksi_produk/{transaksi_produk}/{detail_transaksi_produk}', 'TransaksiProdukController@updateProduk');
        Route::delete('/transaksi_produk/{transaksi_produk}/{detail_transaksi_produk}', 'TransaksiProdukController@destroyProduk');

        //transaksi dan pembayaran layanan
        Route::get('/transaksi_layanan', 'TransaksiLayananController@index');
        Route::get('/transaksi_layanan/{transaksi_layanan}', 'TransaksiLayananController@show')->name('ShowDetailTransaksiLayanan');
        Route::get('/search_transaksi_layanan','TransaksiLayananController@search');

        Route::get('/transaksi_layanan/{transaksi_layanan}/cetakStruk', 'TransaksiLayananController@cetakStruk');

        //detail transaksi layanan dan pembayaran layanan
        Route::get('/transaksi_layanan/{transaksi_layanan}/createlayanan', 'TransaksiLayananController@createlayanan');
        Route::post('/transaksi_layanan/{transaksi_layanan}', 'TransaksiLayananController@storelayanan');
        Route::get('/transaksi_layanan/{transaksi_layanan}/{detail_transaksi_layanan}/editlayanan', 'TransaksiLayananController@editlayanan');
        Route::patch('/transaksi_layanan/{transaksi_layanan}/{detail_transaksi_layanan}', 'TransaksiLayananController@updatelayanan');
        Route::delete('/transaksi_layanan/{transaksi_layanan}/{detail_transaksi_layanan}', 'TransaksiLayananController@destroylayanan');
    });

    Route::middleware(['role:3'])->group(function () {

        //pembayaran produk
        Route::post('/transaksi_produk/{transaksi_produk}/pembayaran','TransaksiProdukController@pembayaran');

        //pembayaran layanan
        Route::post('/transaksi_layanan/{transaksi_layanan}/pembayaran','TransaksiLayananController@pembayaran');

        //filter yang maksa
        Route::get('/transaksi_layanan_belum', 'TransaksiLayananController@filterPertama');
        Route::get('/transaksi_layanan_lunas', 'TransaksiLayananController@filterKedua');
    });
});


//login
Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');

//logout
Route::get('/logout','AuthController@logout');