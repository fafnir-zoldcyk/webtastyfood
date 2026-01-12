<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Gambar;
use App\Models\Kontak;
use App\Models\Tentang;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard', [
        'totalBerita' => Berita::count(),
        'totalGaleri' => Gallery::count(),
        'totalKontak' => Kontak::count(),
        'beritaTerbaru' => Berita::latest()->take(5)->get(),
    ]);
    }
    public function berita(){
        $data['berita'] = Berita::all();
        return view('admin.berita',$data);
    }
    public function tentang(){
    $data['tentang'] = Tentang::all();
    $data['gambars'] = Gambar::all();
    return view('admin.tentang', $data);
}

    public function gambar(){
        $data['gambar'] = Gambar::all();
        return view('admin.gambar',$data);
    }
    public function kontak(){
        $data['kontak'] = Kontak::all();
        return view('admin.kontak',$data);
    }
    public function gallery(){
        $data['gallery'] = Gallery::all();
        return view('admin.gallery',$data);
    }
    public function user(){
        $data['user'] = User::all();
        return view('admin.user',$data);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:3',
            'role' => 'required|string|max:50'
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('admin.user')->with('success','User Berhasil Ditambahkan');
    }
    private function decryptId($id){
        try{
            return decrypt($id);
        }catch (DecryptException $e){
            abort(404);
        }
    }
    public function update(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:3'
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('admin.user')->with('success','User Berhasil Di Update');   
    }
    public function delete($id){
        $id = $this->decryptId($id);
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','User Berhasil Di Hapus');
    }
    
}
