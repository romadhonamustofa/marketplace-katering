<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;



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

Route::get('/', [\App\Http\Controllers\HomepageController::class, 'index']);

Route::get('/about', [\App\Http\Controllers\HomepageController::class, 'about']);

Route::get('/kontak', [\App\Http\Controllers\HomepageController::class, 'kontak']);

Route::get('/kategori', [\App\Http\Controllers\HomepageController::class, 'kategori']);

Route::get('/kategori/{slug}', [\App\Http\Controllers\HomepageController::class, 'kategori']);

Route::get('/produk', [\App\Http\Controllers\HomepageController::class, 'produk']);

Route::get('/produk/{id}', [\App\Http\Controllers\HomepageController::class, 'produkdetail']);


// shopping cart
Route::group(['middleware' => 'auth'], function() {
  // cart
  Route::resource('/cart', \App\Http\Controllers\CartController::class);
  Route::patch('kosongkan/{id}', [\App\Http\Controllers\CartController::class, 'kosongkan']);
  // cart detail
  Route::resource('/cartdetail', \App\Http\Controllers\CartDetailController::class);
  Route::resource('/alamatpengiriman', \App\Http\Controllers\AlamatPengirimanController::class);
  Route::get('checkout', [\App\Http\Controllers\CartController::class, 'checkout']);
  
});

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function() {
    Route::get('/', [\App\Http\Controllers\ProdukController::class, 'index'])->name('admin');

    //Tambahan route package kategori
    Route::resource('/kategori', \App\Http\Controllers\KategoriController::class);

     //Tambahan route package Produk
     Route::resource('/produk', \App\Http\Controllers\ProdukController::class);

      //Tambahan route package Customer
      Route::resource('/customer', \App\Http\Controllers\CustomerController::class);

      //Tambahan route package Transaksi
      Route::resource('/transaksi', \App\Http\Controllers\TransaksiController::class);

      //Tambahan route package User
      Route::get('/profil', [\App\Http\Controllers\UserController::class, 'index']);
      Route::get('/setting', [\App\Http\Controllers\UserController::class, 'setting']);

      //Tambahan route package Laporan
      Route::get('/laporan', [\App\Http\Controllers\LaporanController::class, 'index']);
      Route::get('/proseslaporan', [\App\Http\Controllers\LaporanController::class, 'proses']);

      // image
      Route::get('image', [\App\Http\Controllers\ImageController::class, 'index'])->name('image.index');
      // simpan image
      Route::post('image', [\App\Http\Controllers\ImageController::class, 'store'])->name('image.store');
      // hapus image by id
      Route::delete('image/{id}', [\App\Http\Controllers\ImageController::class, 'destroy'])->name('image.destroy');

      // upload image kategori
      Route::post('imagekategori', [\App\Http\Controllers\KategoriController::class, 'uploadimage']);
      // hapus image kategori
      Route::delete('imagekategori/{id}', [\App\Http\Controllers\KategoriController::class, 'deleteimage']);

      // upload image produk
      Route::post('produkimage', [\App\Http\Controllers\ProdukController::class, 'uploadimage']);
      // hapus image produk
      Route::delete('produkimage/{id}', [\App\Http\Controllers\ProdukController::class, 'deleteimage']);

      // slideshow
      Route::resource('slideshow', \App\Http\Controllers\SlideshowController::class);

      // produk promo
      Route::resource('promo', \App\Http\Controllers\ProdukPromoController::class);
      // load async produk
      Route::get('loadprodukasync/{id}', [\App\Http\Controllers\ProdukController::class, 'loadasync']);
  });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

