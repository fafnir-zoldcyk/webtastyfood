<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Contracts\Encryption\DecryptException;
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
    private function decryptId($id){
        try{
            return decrypt($id);
        } catch (DecryptException $e){
            abort(404);
        }
    }
    public function update(Request $request, $id){
        $id = $this->decryptId($id);
        $request->validate([
            'nama' => 'required|string|max:40',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:100',
            'pesan' => 'required|string|max:500',
            // 'status' => 'required|in:terbaca,belum terbaca',
        ]);
        $kontak = Kontak::findOrFail($id);
        $kontak->nama = $request->nama;
        $kontak->email = $request->email;
        $kontak->subject = $request->subject;
        $kontak->pesan = $request->pesan;
        // $kontak->status = $request->status;
        $kontak->save();
        return redirect()->back()->with('success', 'Kontak message updated successfully.');
    }
    public function delete($id){
        $id = $this->decryptId($id);
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();
        return redirect()->back()->with('success', 'Kontak message deleted successfully.');
    }
}
