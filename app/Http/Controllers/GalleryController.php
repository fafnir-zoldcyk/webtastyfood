<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallstore(Request $request){
        $request->validate([
            'nama' => 'required|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:5008',
            'tipe' => 'required|in:foto,video'
        ]);

        if ($request->hasFile('nama')) {
            $gallery   = $request->file('nama');
            $filename = time() . '-' . '.' . $gallery->getClientOriginalExtension();
            $gallery->storeAs('gallery', $filename, 'public');
        } else {
            $filename = null;
        }

        // Simpan ke database
        Gallery::create([
            'nama' => $filename,
            'tipe' => $request->tipe
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil ditambahkan.');
    }
    private function decryptId($id){
        try{
            return decrypt($id);
        } catch (DecryptException $e){
            abort(404);
        }
    }

    public function gallupdate(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'nama' => 'nullable|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:5008',
            'tipe' => 'required|in:foto,video'
        ]);

        $gallery = Gallery::findOrFail($id);

        if ($request->hasFile('nama')) {
            $nama   = $request->file('nama');
            $filename = time() . '-'  . '.' . $nama->getClientOriginalExtension();
            $nama->storeAs('gallery', $filename, 'public');
        } else {
            $filename = null;
        }

        // Update database
        $gallery->nama = $filename;
        $gallery->tipe = $request->tipe;
        $gallery->save();

        return redirect()->back()->with('success', 'Gambar berhasil diperbarui.');
    }
    public function galldelete($id){
        $id = $this->decryptId($id);
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}
