<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    
    private function decryptId($id){
        try {
            return decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|max:5000',
            'nama_penulis' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|in:makanan,minuman',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
         if ($request->hasFile('foto')) {
            $foto   = $request->file('foto');
            $filename = time() . '-' . $request->judul . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('foto', $filename, 'public');
        } else {
            $filename = null;
        }
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'nama_penulis' => $request->nama_penulis,
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'foto' => $filename,
            // 'ulasan_id' => ,
        ]);
        return redirect()->route('admin.berita')->with('success','Berita berhasil ditambahkan');
    }
    public function update(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|max:5000',
            'nama_penulis' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|in:makanan,minuman',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('foto')) {
            $foto   = $request->file('foto');
            $filename = time() . '-' . $request->judul . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('foto', $filename, 'public');
            $berita->foto = $filename;
        }

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->nama_penulis = $request->nama_penulis;
        $berita->tanggal = $request->tanggal;
        $berita->kategori = $request->kategori;
        $berita->save();

        return redirect()->route('admin.berita')->with('success','Berita berhasil diupdate');
    }
    public function delete($id){
        $id = $this->decryptId($id);
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('admin.berita')->with('success','Berita berhasil dihapus');
    }
}
