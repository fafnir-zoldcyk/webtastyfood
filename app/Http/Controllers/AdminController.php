<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Gambar;
use App\Models\Kontak;
use App\Models\Tentang;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function berita(){
        $data['berita'] = Berita::all();
        return view('admin.berita',$data);
    }
    public function tentang(){
        $data['tentang'] = Tentang::all();
        return view('admin.tentang',$data);
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
}
