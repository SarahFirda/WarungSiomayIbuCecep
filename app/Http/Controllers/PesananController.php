<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class PesananController extends Controller
{
    public function Checkout(Request $request)
    {
        $pesanan = session("pesanan");

        $order = Pesanan::create([
            'id_antrian' => $pesanan['id'],
            'status_pesanan' => 'Belum Selesai',
            'jenis_pesanan' => $pesanan['jenis_pesanan'],
            'status_pembayaran' => $pesanan['opsi_pembayaran'] == 'Bayar Ditempat' ? 'Belum Dibayar' : 'Sudah Dibayar' ,
            'total_harga' => $pesanan['total_harga']
        ]);

        $orderId = $order->id_pesanan;

        foreach($pesanan['keranjang'] as $item){
            $order->Details()->create([
                'id_pesanan' => $orderId,
                'id_menu' => $item['id_menu'],
                'jumlah_menu' => $item['jumlah_menu'],
                'add_on' => $item['add_on'],
                'harga_satuan' => $item['harga_menu'],
            ]);
        }        

        Cookie::queue(Cookie::forget('antrian'));
        $request->session()->forget('pesanan');
        $request->session()->forget('keranjang');

        return redirect("pesanan/$orderId");
    }

    public function Detail($id_pesanan)
    {
        $pesanan = Pesanan::findOrFail($id_pesanan);
        $pesanan_detail = $pesanan->Details;
        $ratings = Rating::where('id_antrian', $pesanan->id_antrian)->get();
                
        return view('pesanan', compact('pesanan', 'pesanan_detail', 'ratings'));
    }
    
}