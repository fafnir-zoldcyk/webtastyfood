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
        $data['galeri'] = Gallery::latest()->skip(1)->take(3)->get();
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
    public function profile(){
        $data['user'] = Auth::user();
        return view('user.profile', $data);
    }
    public function profileEdit($id){
        $id = $this->decryptId($id);
        $data['user'] = User::find($id);
        return view('user.profile-edit', $data);
    }
    public function profileUpdate(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,',
            'profile' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:3',
        ]);  
          $user = User::find($id);
          if ($request->hasFile('profile')) {
            $profile   = $request->file('profile');
            $filename = time() . '-' . $request->name . '.' . $profile->getClientOriginalExtension();
            $profile->storeAs('profile', $filename, 'public');
        } else {
            $filename = $user->profile;
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'profile' => $filename
        ]);
        return redirect()->route('user.profile')->with('pesan', 'Profile updated successfully.');
    }

}
