<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = \App\About::get();
        return view('abouts.index', ['abouts' => $abouts ]);
    }

    public function edit($id)
    {
        $about = \App\About::findOrFail($id);
        return view('abouts.edit', ['about' => $about]);
    }

    public function update(Request $request, $id)
    {
        $about = \App\About::findOrFail($id);

        // 1. Validasi
        Validator::make($request->all(),[
            'caption' => 'required|min:15',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hero_bg' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ])->validate();
        
        try {
            // 2. Update data teks
            $about->caption         = $request->get('caption');
            $about->whatsapp        = $request->get('whatsapp');
            $about->jam_operasional = $request->get('jam_operasional');
            $about->alamat           = $request->get('alamat');
            $about->footer_text      = $request->get('footer_text');

            // 3. Update Foto Profil
            if($request->hasFile('image')){
                // Hapus foto lama jika ada
                if($about->image && File::exists(public_path('about_image/'.$about->image))){
                    File::delete(public_path('about_image/'.$about->image));
                }
                
                $file = $request->file('image');
                $nama_file = time()."_".$file->getClientOriginalName();
                $file->move(public_path('about_image'), $nama_file);
                $about->image = $nama_file;
            }

            // 4. Update Foto Background Hero
            if($request->hasFile('hero_bg')){
                // Hapus background lama jika ada
                if($about->hero_bg && File::exists(public_path('about_image/'.$about->hero_bg))){
                    File::delete(public_path('about_image/'.$about->hero_bg));
                }
                
                $file_hero = $request->file('hero_bg');
                $nama_hero = "hero_".time()."_".$file_hero->getClientOriginalName();
                $file_hero->move(public_path('about_image'), $nama_hero);
                $about->hero_bg = $nama_hero;
            }

            // 5. Simpan Permanen ke Database
            $about->save();

            return redirect()->route('abouts.index')->with('success', 'Perubahan berhasil disimpan permanen ke database!');

        } catch (\Exception $e) {
            // Jika ada error (misal database mati), tampilkan pesan errornya
            return redirect()->back()->with('error', 'Gagal menyimpan! Error: ' . $e->getMessage());
        }
    }
}