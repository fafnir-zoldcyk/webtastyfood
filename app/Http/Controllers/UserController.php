<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Kontak;
use App\Models\Tentang;
use Illuminate\Http\Request;

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
        $data['lainnya'] = Berita::all();
        return view('user.berita',$data);
    }
}
