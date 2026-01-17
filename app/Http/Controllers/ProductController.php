<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Product::with('category')->latest();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Filter Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10);
        $categories = \App\Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Sanitize input: Hapus titik/koma dari harga agar jadi integer murni
        $request->merge([
            'price' => str_replace('.', '', $request->get('price')),
        ]);

        // Validasi data
        Validator::make($request->all(), [
            'name'          => 'required|min:2|max:20',
            'code'          => 'required|unique:products,code',
            'category_id'   => 'required|exists:categories,id',
            'stock'         => 'nullable|integer|min:0',
            'price'         => 'nullable|numeric|min:0', 
            'description'   => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ])->validate();

        $product = new \App\Product();
        $product->name = $request->get('name');
        
        $product->category_id = $request->get('category_id');
        $category = \App\Category::find($request->get('category_id'));
        $product->group = $category ? $category->name : 'General';

        $product->code = $request->get('code');
        $product->stock = $request->get('stock') ?? 0;
        $product->price = $request->get('price') ?? 0; // Price sudah bersih
        $product->description = $request->get('description');

        if ($request->file('image')) {
            $nama_file = time() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('product_image'), $nama_file);
            $product->image = $nama_file;
        } elseif ($category && $category->image) {
            $sourcePath = public_path('category_image/' . $category->image);
            if (file_exists($sourcePath)) {
                $extension = pathinfo($sourcePath, PATHINFO_EXTENSION);
                $nama_file = time() . "_default_" . $category->id . "." . $extension;
                File::copy($sourcePath, public_path('product_image/' . $nama_file));
                $product->image = $nama_file;
            }
        }

        $product->slug = Str::slug($request->get('name'));
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Method ini tidak digunakan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = \App\Product::findOrFail($id);
        $categories = \App\Category::all();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = \App\Product::findOrFail($id);
        
        // 1. Sanitize harga (hapus titik)
        $request->merge([
            'price' => str_replace('.', '', $request->get('price')),
        ]);

         // Validasi data
         Validator::make($request->all(), [
            'name'          => 'required|min:2|max:20',
            'category_id'   => 'required|exists:categories,id',
            'stock'         => 'nullable|integer|min:0',
            'price'         => 'nullable|numeric|min:0', 
            'description'   => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ])->validate();

        $product->name = $request->get('name');
        
        $product->category_id = $request->get('category_id');
        $category = \App\Category::find($request->get('category_id'));
        $product->group = $category ? $category->name : 'General';

        $product->stock = $request->get('stock') ?? 0;
        $product->price = $request->get('price') ?? 0; // Price bersih
        $product->description = $request->get('description');

        if ($request->file('image')) {
            // Hapus gambar lama
            if ($product->image && file_exists(public_path('product_image/' . $product->image))) {
                File::delete(public_path('product_image/' . $product->image));
            }

            $nama_file = time() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('product_image'), $nama_file);
            $product->image = $nama_file;
        }

        $product->slug = Str::slug($request->get('name'));
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = \App\Product::findOrFail($id);
        if ($product->image && file_exists(public_path('product_image/' . $product->image))) {
            File::delete(public_path('product_image/' . $product->image));
        }
        $product->forceDelete(); // Langsung hapus permanen atau soft delete sesuai kebutuhan
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // --- Metode tambahan (restore, deletePermanent, ajaxSearch) ---

    public function restore($id)
    {
        $product = \App\Product::withTrashed()->findOrFail($id);
        $product->restore();
    }

    public function deletePermanent($id)
    {
        $product = \App\Product::withTrashed()->findOrFail($id);
        if ($product->image) {
            File::delete(public_path('category_image/' . $product->image));
        }
        $product->forceDelete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus secara permanen.');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $products = \App\Product::where('name', 'Like', "%$keyword%")->get();
        return $products;
    }
}
