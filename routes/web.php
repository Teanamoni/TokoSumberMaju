<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute ini
| dimuat oleh RouteServiceProvider di dalam sebuah grup yang
| berisi middleware "web".
|
*/

// ====================================================
// 1. FRONTEND / PUBLIK (Bisa diakses siapa saja)
// ====================================================

Route::get('/', 'UserController@index')->name('home');
Route::get('/home', 'UserController@index'); // Opsional: Redirect /home ke index
Route::get('/search', 'UserController@search')->name('search');
Route::get('/product/{id}', 'UserController@productDetail')->name('product.detail');


// ====================================================
// 2. AUTHENTICATION (Login, Logout, Reset Pass)
// ====================================================

// Menonaktifkan register agar tidak sembarang orang bisa daftar
Auth::routes(['register' => false]);


// ====================================================
// 3. ADMIN PANEL (Harus Login)
// ====================================================

Route::prefix('admin')->middleware('auth')->group(function () {

  // 3.1. DASHBOARD & PENGATURAN AKUN
  // Rute akan menjadi: /admin/
  Route::get('/', 'DashboardController@index');
  // Rute akan menjadi: /admin/dashboard
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

  // Pengaturan Akun Admin
  // Rute akan menjadi: /admin/settings
  Route::get('/settings', 'DashboardController@settings')->name('admin.settings');
  Route::put('/settings', 'DashboardController@updateSettings')->name('admin.settings.update');

  // 3.2. MANAJEMEN MASTER DATA (groups, categories, abouts)

  // A. Manajemen Jenis Kategori (Product Group)
  // Rute: /admin/groups (CRUD) -> groups.index, groups.create, dst.
 

  // B. Manajemen Produk (Katalog Produk)
  // Rute: /admin/products (CRUD) -> products.index, products.create, dst.
  Route::resource('products', 'ProductController');
  
  // C. Manajemen Kategori
  // Rute: /admin/categories (CRUD) -> categories.index, categories.create, dst.
  Route::resource('categories', 'CategoryController');

  // Custom Routes untuk Soft Deletes Products
  // Rute: /admin/products/{product}/restore
  Route::get('/products/{product}/restore', 'ProductController@restore')->name('products.restore');
  // Rute: /admin/products/{product}/delete-permanent
  Route::delete('/products/{product}/delete-permanent', 'ProductController@deletePermanent')->name('products.delete-permanent');

  // Ajax Search
  // Rute: /admin/ajax/products/search
  Route::get('/ajax/products/search', 'ProductController@ajaxSearch');


  // C. Manajemen About (Info Toko/Perusahaan)
  // Rute: /admin/abouts (Jika menggunakan resource, tapi Anda menggunakan rute terpisah)
  Route::get('/abouts', 'AboutController@index')->name('abouts.index');
  Route::get('/abouts/create', 'AboutController@create')->name('abouts.create');
  Route::post('/abouts', 'AboutController@store')->name('abouts.store');
  Route::get('/abouts/{about}/edit', 'AboutController@edit')->name('abouts.edit');
  Route::put('/abouts/{about}', 'AboutController@update')->name('abouts.update');
});
