<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function markasRead( $id){
        $kontak = Kontak::findOrFail($id);
        $kontak->status = 'terbaca';
        $kontak->save();
        return redirect()->back()->with('success', 'Kontak message marked as read.');
    }
    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:100',
            'pesan' => 'required|string|max:500',
        ]);

        Kontak::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'subject' => $request->subject,
            'pesan' => $request->pesan,
        ]);
        return redirect()->back()->with('success','Pesan Anda telah terkirim. Terima kasih!');
    }
}
