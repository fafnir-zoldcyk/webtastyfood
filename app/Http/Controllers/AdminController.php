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
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ======================
    // DASHBOARD
    // ======================
    public function index(){
        return view('admin.dashboard', [
            'totalBerita' => Berita::count(),
            'totalGaleri' => Gallery::count(),
            'totalKontak' => Kontak::count(),
            'beritaTerbaru' => Berita::latest()->take(5)->get(),
        ]);
    }

    public function berita(){
        return view('admin.berita', [
            'berita' => Berita::all()
        ]);
    }

    public function tentang(){
        return view('admin.tentang', [
            'tentang' => Tentang::all(),
            'gambars' => Gambar::all()
        ]);
    }

    public function gambar(){
        return view('admin.gambar', [
            'gambar' => Gambar::all()
        ]);
    }

    public function kontak(){
        return view('admin.kontak', [
            'kontak' => Kontak::all()
        ]);
    }

    public function gallery(){
        return view('admin.gallery', [
            'gallery' => Gallery::all()
        ]);
    }

    // ======================
    // USER
    // ======================
    public function user(){
        return view('admin.user', [
            'user' => User::all()
        ]);
    }

    // ======================
    // STORE USER
    // ======================
    public function store(Request $request){
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'profile'  => 'required|file|mimes:jpg,jpeg,png,gif|max:5080',
            'role'     => 'required|string|max:50'
        ]);

        $filename = null;

        if ($request->hasFile('profile')) {
            $profile  = $request->file('profile');
            $filename = time() . '-' . $request->name . '.' . $profile->getClientOriginalExtension();
            $profile->storeAs('profile', $filename, 'public');
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'profile'  => $filename,
            'role'     => $request->role
        ]);

        return redirect()->route('admin.user')
            ->with('success','User berhasil ditambahkan');
    }

    // ======================
    // DECRYPT ID
    // ======================
    private function decryptId($id){
        try {
            return decrypt($id);
        } catch (DecryptException $e){
            abort(404);
        }
    }

    // ======================
    // UPDATE USER + FOTO
    // ======================
    public function update(Request $request, $id){
        $id = $this->decryptId($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:3',
            'profile'  => 'nullable|file|mimes:jpg,jpeg,png,gif|max:5080',
            'role'     => 'required|string|max:50'
        ]);

        $user = User::findOrFail($id);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role
        ];

        // update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // update foto profile jika ada
        if ($request->hasFile('profile')) {

            // hapus foto lama
            if ($user->profile && Storage::disk('public')->exists('profile/' . $user->profile)) {
                Storage::disk('public')->delete('profile/' . $user->profile);
            }

            $profile  = $request->file('profile');
            $filename = time() . '-' . $request->name . '.' . $profile->getClientOriginalExtension();
            $profile->storeAs('profile', $filename, 'public');

            $data['profile'] = $filename;
        }

        $user->update($data);

        return redirect()->route('admin.user')
            ->with('success','User berhasil diupdate');
    }

    // ======================
    // DELETE USER
    // ======================
    public function delete($id){
        $id = $this->decryptId($id);

        $user = User::findOrFail($id);

        // hapus foto profile
        if ($user->profile && Storage::disk('public')->exists('profile/' . $user->profile)) {
            Storage::disk('public')->delete('profile/' . $user->profile);
        }

        $user->delete();

        return redirect()->back()
            ->with('success','User berhasil dihapus');
    }
}
