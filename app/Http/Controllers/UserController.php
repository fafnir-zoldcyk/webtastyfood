<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Komentar;
use App\Models\Kontak;
use App\Models\Tentang;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home(){
        $data['utama'] = Berita::latest()->first();
        $data['tentang'] = Tentang::latest()->skip(1)->take(4)->get();
        $data['berita'] = Berita::latest()->skip(1)->take(4)->get();
        $data['galeri'] = Gallery::all();
        return view('user.home',$data);
    }
    public function tentang(){
        return view('user.tentang');
    }
    public function kontak(){
        $data['berita'] = Berita::latest()->first();
        $data['lainnya'] = Berita::all();
        return view('user.kontak', $data);
    }
    public function gallery(){
        $data['galeri'] = Gallery::all();
        return view('user.galleri',$data);
    }
    public function berita(){
        $data['berita'] = Berita::latest()->first();
        $data['komentar'] = Komentar::all();
        $data['lainnya'] = Berita::all();
        return view('user.berita',$data);
    }
    public function login(){
        return view('login');
    }
    public function loginPost(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success','Selamat Datang Admin');
            }
            if (Auth::user()->role == 'user') {
                return redirect()->route('user.home')->with('success','Selamat Datang Member');
            }
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('user.home')->with('success','Anda telah logout');
    }
    private function decryptId($encryptedId){
        try {
            return decrypt($encryptedId);
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    public function beritadetail($id){
        $id = $this->decryptId($id);
        $data['berita'] = Berita::find($id);
        $data['komentar'] = Komentar::where('berita_id', $id)->get();
        $data['lainnya'] = Berita::all();
        return view('user.detail',$data);
    }
    public function register(){
        return view('register');
    }
    public function registerPost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('admin.login')->with('success', 'Registration successful. Please login.');
    }
}
