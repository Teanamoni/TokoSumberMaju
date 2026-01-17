<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; // Model Produk
use App\About;    // Model Tentang Toko

class UserController extends Controller
{
  /**
   * Halaman Utama (Home)
   */
  public function index()
  {
    // 1. Ambil data Tentang Toko
    $about = About::first();

    // 2. Ambil Data Kategori & Kelompokkan
    // Update: Tambahkan filter pencarian jika ada
    $query = Product::latest();

    if (request()->has('search') && request()->search != '') {
        $search = request()->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('group', 'like', '%' . $search . '%');
        });
    }

    $products = $query->get()->groupBy('group');

    // 3. Ambil data Admin untuk kontak (misal user id 1)
    $admin = \App\User::first(); 

    return view('user.home', compact('products', 'about', 'admin'));
  }

  /**
   * Halaman Detail Kategori
   */
  public function productDetail($id)
  {
    // 1. Cari produk yang diklik
    $clickedProduct = Product::findOrFail($id);

    // 2. Ambil nama grupnya (Misal: "Semen")
    $groupName = $clickedProduct->group;

    // 3. Ambil SEMUA produk lain yang memiliki group sama
    $products = Product::where('group', $groupName)->latest()->get();

    // 4. Ambil data Admin untuk kontak
    $admin = \App\User::first();

    // 5. Kirim data ke view detail
    return view('user.product_detail', [
      'group_name' => $groupName,
      'products'   => $products,
      'sample'     => $clickedProduct,
      'admin'      => $admin
    ]);
  }


  /**
   * Halaman Pencarian Produk
   */
  public function search(\Illuminate\Http\Request $request)
  {
      $search = $request->search;
      $products = Product::where('name', 'like', "%{$search}%")
                  ->orWhere('group', 'like', "%{$search}%")
                  ->latest()->get();
      
      $admin = \App\User::first();

      return view('user.product_detail', [
          'group_name' => 'Hasil Pencarian: "' . $search . '"',
          'products'   => $products,
          'sample'     => $products->first(),
          'admin'      => $admin
      ]);
  }
}
