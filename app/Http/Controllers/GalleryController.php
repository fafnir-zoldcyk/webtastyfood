<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallstore(Request $request){
        $request->validate([
            'gambar' => 'required|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:2048',
            'tipe' => 'required|in:foto,video'
        ]);

        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->storeAs('galeri', $namaGambar);

        // Simpan ke database
        Gallery::create([
            'gambar' => $namaGambar,
            'tipe' => $request->tipe
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil ditambahkan.');
    }
    private function decryptId($id){
        try{
            return decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e){
            abort(404);
        }
    }

    public function gallupdate(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:2048',
            'tipe' => 'required|in:foto,video'
        ]);

        $gallery = Gallery::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('galeri', $namaGambar);
        } else {
            $namaGambar = $gallery->gambar;
        }

        // Update database
        $gallery->update([
            'gambar' => $namaGambar,
            'tipe' => $request->tipe
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil diperbarui.');
    }
    public function galldelete($id){
        $id = $this->decryptId($id);
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}
