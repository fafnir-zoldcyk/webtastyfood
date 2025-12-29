<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    
    private function decryptId($id){
        try {
            return decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }   
    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:500',
            'visi' => 'required|string|max:250',
            'misi' => 'required|string|max:250',
            'gmail' => 'required|email|max:100',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            // 'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2040'
        ]);

        // if ($request->hasFile('gambar')) {
        //     $gambar   = $request->file('gambar');
        //     $filename = time() . '-' . $request->nama . '.' . $gambar->getClientOriginalExtension();
        //     $gambar->storeAs('gambar', $filename, 'public');
        // } else {
        //     $filename = null;
        // }
        Tentang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'gmail' => $request->gmail,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            // 'gambar' => $filename,
        ]);
        return redirect()->route('admin.tentang')->with('success','Data Tentang Kami berhasil ditambahkan');
    }
    public function update(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'nama' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:500',
            'visi' => 'required|string|max:250',
            'misi' => 'required|string|max:250',
            'gmail' => 'required|email|max:100',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            // 'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2040'
        ]);

        $tentang = Tentang::findOrFail($id);

        // if ($request->hasFile('gambar')) {
        //     $gambar   = $request->file('gambar');
        //     $filename = time() . '-' . $request->nama . '.' . $gambar->getClientOriginalExtension();
        //     $gambar->storeAs('gambar', $filename, 'public');
        // } else {
        //     $filename = $tentang->gambar;
        // }

        $tentang->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'gmail' => $request->gmail,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            // 'gambar' => $filename,
        ]);
        return redirect()->route('admin.tentang')->with('success','Data Tentang Kami berhasil diupdate');
    }
    public function delete($id){
        $id = $this->decryptId($id);
        $tentang = Tentang::findOrFail($id);
        $tentang->delete();
        return redirect()->route('admin.tentang')->with('success','Data Tentang Kami berhasil dihapus');
    }
}
