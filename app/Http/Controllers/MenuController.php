<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function Index(Request $request)
    {
        $antrian = $request->cookie('antrian');        
        $keranjang = session("keranjang",[]);
        $pesanan = session("pesanan",[]);

        $data = Menu::all();

        return view('menu.index',compact('data','keranjang','pesanan','antrian'));
    }
    
    public function Detail($id_produk, Request $request)
    {
        $antrian = $request->cookie('antrian');
        $data = Menu::findOrFail($id_produk);
        return view('menu.detail',compact('data','antrian'));
    }
}