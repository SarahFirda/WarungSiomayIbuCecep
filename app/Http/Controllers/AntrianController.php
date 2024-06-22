<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Routing\Controller;

class AntrianController extends Controller
{
    public function OpsiMakan($jenis_pesanan){
        $pesanan = ['jenis_pesanan' => $jenis_pesanan == "makandisini" ? "Makan Disini" : "Dibungkus"];
        session(['pesanan' => $pesanan]);
        return redirect("/menu");
    }
    
    
    public function AmbilAntrian(Request $request)
    {
        $id_nomor_antrian = $request->cookie('antrian');
        $nomor_antrian_terakhir = Antrian::latest('id_antrian')->first()->nomor_antrian ?? 0;
        
        if (!$id_nomor_antrian || $nomor_antrian_terakhir == 0) {
            $nomor_antrian_baru = $nomor_antrian_terakhir + 1;
            $antrian = Antrian::create(['nomor_antrian' => $nomor_antrian_baru]);
            $id_nomor_antrian = $antrian->id_antrian;
            Cookie::queue('antrian', $id_nomor_antrian, 120);
        }
        
        $antrian = Antrian::findOrFail($id_nomor_antrian);
        $nomor_antrian = $antrian->nomor_antrian;
        
        return view('antrian', compact('nomor_antrian'));
    }
    
    public function ResetAntrian(){
        $nomor_antrian_terakhir = Antrian::latest('id_antrian')->first()->nomor_antrian;
        if($nomor_antrian_terakhir == 0){
            return redirect('/dashboard')->with('success', 'Antrian sudah di reset');
        } else {
            Antrian::create(['nomor_antrian' => 0]);
            return redirect('/dashboard')->with('success', 'Antrian berhasil di reset');
        }
    }
}