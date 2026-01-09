<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function komentar(Request $request){
        $request->validate([
            'berita_id' => 'required|exists:beritas,id',
            'rating' => 'required|numeric|between:0,5',
            'komentar' => 'required|string|max:500',
        ]);
        Komentar::create([
            'berita_id' => $request->berita_id,
            'nama' => Auth::user()->name,
            'email' => Auth::user()->email,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);
        return redirect()->back()->with('success','Komentar Anda telah terkirim. Terima kasih!');
    }
}
