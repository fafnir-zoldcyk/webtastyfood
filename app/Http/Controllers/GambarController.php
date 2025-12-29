<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Request;

class GambarController extends Controller
{
    
    public function store(Request $request){
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2040',
            'tipe' => 'required|in:perusahaan,visi,misi'
        ]);

        if ($request->hasFile('gambar')) {
            $file_gambar   = $request->file('gambar');
            $filename = time() . '-' . $request->judul . '.' . $file_gambar->getClientOriginalExtension();
            $file_gambar->storeAs('gambar', $filename, 'public');
        } else {
            $filename = null;
        }
        Gambar::create([
            'gambar' => $filename,
            'tipe' => $request->tipe,
        ]);
        return redirect()->route('admin.gambar')->with('success','Data Gambar berhasil ditambahkan');
    }
    private function decryptId($id){
        try{
            return decrypt($id);
        } catch (DecryptException $e){
            abort(404);
        }
        }
    public function update(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2040',
            'tipe' => 'required|in:perusahaan,visi,misi'
        ]);

        $gambar = Gambar::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $file_gambar   = $request->file('gambar');
            $filename = time() . '-' . $request->judul . '.' . $file_gambar->getClientOriginalExtension();
            $file_gambar->storeAs('gambar', $filename, 'public');
            // Optionally delete the old image file here
        } else {
            $filename = $gambar->gambar;
        }

        $gambar->update([
            'gambar' => $filename,
            'tipe' => $request->tipe,
        ]);
        return redirect()->route('admin.gambar')->with('success','Data Gambar berhasil diupdate');
    }
    public function delete($id){
        $id = $this->decryptId($id);
        $gambar = Gambar::findOrFail($id);
        // Optionally delete the image file from storage here
        $gambar->delete();
        return redirect()->route('admin.gambar')->with('success','Data Gambar berhasil dihapus');
    }
}
