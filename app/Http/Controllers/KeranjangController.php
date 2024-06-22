<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function Index(Request $request)
    {
        $keranjang = session("keranjang",[]);
        $pesanan = session("pesanan");
        $antrian = $request->cookie('antrian');


        $pesanan = [
            'id' => $request->cookie('antrian'),
            'jenis_pesanan' => $pesanan['jenis_pesanan'] ?? null,
            'total_harga' => $pesanan['total_harga'] ?? null,
            'opsi_pembayaran' => $pesanan['opsi_pembayaran'] ?? null
        ];

        if($pesanan['opsi_pembayaran'] == 'Transfer'){
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
    
            $params = array(
                'transaction_details' => array(
                    'order_id' => $antrian,
                    'gross_amount' => $pesanan['total_harga'],
                ),
                'customer_details' => array(
                    'name' => 'customer_' . $request->cookie('antrian'),
                ),
            );
    
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        }
        
        $pesanan['keranjang'] = $keranjang;
    
        session(['pesanan' => $pesanan]);
    
        return view("keranjang.index",[
            "keranjang" => $keranjang,
            "pesanan" => $pesanan,
            "antrian" => $antrian,
            "snapToken" => $snapToken ?? null,
        ]);
    }

    public function OpsiPembayaran($opsi)
    {
        $pesanan  = session("pesanan");
        $pesanan['opsi_pembayaran'] = ($opsi == "ditempat") ? 'Bayar Ditempat' : 'Transfer';
        session(['pesanan' => $pesanan]);
    
        return redirect("/keranjang");
    }
    

    public function TambahKeranjang($id_menu, Request $request)
    {
        $keranjang = session("keranjang");
        $pesanan = session("pesanan");

        $menu = Menu::where("id_menu", $id_menu)->first();

        $keranjang[] = [
            "id_menu" => $menu->id_menu,
            "nama_menu" => $menu->nama_menu,
            "harga_menu" => $menu->harga_menu,
            "catatan" => $request->catatan,
            "add_on" => $request->add_on ? json_encode($request->add_on) : json_encode(['Lengkap']),
            "jumlah_menu" => $request->jumlah_menu,
        ];        

        session(['keranjang'=>$keranjang]);
        
        $total_harga = 0;
        foreach ($keranjang as &$item) {
            $item['sub_total'] = $item['jumlah_menu'] * $item['harga_menu'];
            $total_harga += $item['sub_total'];
        }
        
        $pesanan['total_harga'] = $total_harga;
        session(['pesanan'=>$pesanan]);
        
        return redirect("/menu");
    }

    public function EditKeranjang($id)
    {
        $index = $id;
        $keranjang = session("keranjang");
        
        if (!isset($keranjang[$index])) {
            return redirect('/keranjang');
        }

        $data = $keranjang[$index];
        $menu = Menu::query()->findOrFail($keranjang[$index]['id_menu']);
        return view('keranjang.edit',compact('data','menu','index'));
    }

    public function UpdateKeranjang($index, Request $request)
    {
        $keranjang = session("keranjang");
        $pesanan = session("pesanan");

        $keranjang[$index] = [
            "id_menu" => $keranjang[$index]['id_menu'],
            "nama_menu" => $keranjang[$index]['nama_menu'],
            "harga_menu" => $keranjang[$index]['harga_menu'],
            "add_on" => $request->add_on ? json_encode($request->add_on) : json_encode(['Lengkap']),
            "catatan" => $request->catatan,
            "jumlah_menu" => $request->jumlah_menu,
        ];

        $total_harga = 0;
        foreach ($keranjang as &$item) {
            $item['sub_total'] = $item['jumlah_menu'] * $item['harga_menu'];
            $total_harga += $item['sub_total'];
        }
        
        $pesanan['total_harga'] = $total_harga;
    
        session(['keranjang' => $keranjang]);
        session(['pesanan'=>$pesanan]);
    
        return redirect("/keranjang");
    }
    

    public function HapusKeranjang($index)
    {
        $keranjang = session("keranjang");
        $pesanan = session("pesanan");
        unset($keranjang[$index]);

        $grandtotal = 0;
        foreach ($keranjang as &$item) {
            $item['sub_total'] = $item['qty'] * $item['harga'];
            $grandtotal += $item['sub_total'];
        }
        $pesanan['grand_total'] = $grandtotal;

        session(["keranjang" => $keranjang]);
        session(['pesanan'=>$pesanan]);
        
        return redirect("/keranjang");
    }
}
