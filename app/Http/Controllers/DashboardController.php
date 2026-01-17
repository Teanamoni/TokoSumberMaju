<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. Inisialisasi Data Ringkasan
        $total_katalog = 0;
        $produk_tersedia = 0;
        $produk_tidak_tersedia = 0;

        // 2. Query Data Produk Otomatis Berdasarkan Stok
        if (class_exists('\App\Product')) {
            $total_katalog = \App\Product::count();
            
            // Logika: Jika stok > 0 maka Tersedia
            $produk_tersedia = \App\Product::where('stock', '>', 0)->count();
            
            // Logika: Jika stok <= 0 maka Tidak Tersedia
            $produk_tidak_tersedia = \App\Product::where('stock', '<=', 0)->count();
        }

        // 3. Logika Grafik Pengunjung (7 Hari Terakhir)
        $total_pengunjung = 0;
        $chartLabels = [];
        $chartValues = [];

        try {
            if (class_exists('\App\Visitor')) {
                // Menghitung total seluruh pengunjung (hits)
                $total_pengunjung = \App\Visitor::count();

                $chartData = \App\Visitor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->where('created_at', '>=', Carbon::now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date', 'ASC')
                    ->get();

                // Loop untuk merapikan urutan tanggal di grafik
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i)->format('Y-m-d');
                    $chartLabels[] = Carbon::now()->subDays($i)->format('d M');

                    $visitor = $chartData->where('date', $date)->first();
                    $chartValues[] = $visitor ? $visitor->total : 0;
                }
            } else {
                // Fallback jika tabel visitor belum ada
                for ($i = 6; $i >= 0; $i--) {
                    $chartLabels[] = Carbon::now()->subDays($i)->format('d M');
                    $chartValues[] = 0;
                }
            }
        } catch (\Exception $e) {
            $chartLabels = ['Error DB'];
            $chartValues = [0];
        }

        // 4. Kirim Data ke View
        return view('dashboards.index', [
            'total_katalog'         => $total_katalog,
            'produk_tersedia'       => $produk_tersedia,
            'produk_tidak_tersedia' => $produk_tidak_tersedia,
            'total_pengunjung'      => $total_pengunjung,
            'chartLabels'           => $chartLabels,
            'chartValues'           => $chartValues
        ]);
    }

    /**
     * Menampilkan pengaturan profil admin.
     */
    public function settings()
    {
        return view('dashboards.settings');
    }

    /**
     * Update profil admin.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            $destinationPath = 'avatars/';
            if ($user->avatar && $user->avatar != 'default.jpg' && file_exists(public_path($destinationPath . $user->avatar))) {
                unlink(public_path($destinationPath . $user->avatar));
            }
            
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path($destinationPath), $imageName);
            $user->avatar = $imageName;
        }

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah!']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Fungsi tambahan lainnya dibiarkan kosong agar tidak merusak routing yang sudah ada
    public function create() { }
    public function store(Request $request) { }
    public function show($id) { }
    public function edit($id) { }
    public function update(Request $request, $id) { }
    public function destroy($id) { }
}