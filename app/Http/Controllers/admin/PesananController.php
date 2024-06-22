<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananDetail;

class PesananController extends Controller
{
    public function Index()
    {
        $data = Pesanan::all();

        return view('dashboard.pesanan.index',compact('data'));
    }

    public function Show(string $id)
    {
        $data = Pesanan::query()->findOrFail($id);

        return view('dashboard.pesanan.detail',compact('data'));
    }

    public function TambahDetailPesanan($id)
    {
        $model = new PesananDetail;
        $menu = Menu::all();

        $id_pesanan = $id;

        return view('dashboard.pesanan.formMenu',compact('model','menu','id_pesanan'));
    }

    public function StoreDetailPesanan(Request $request)
    {
        $validatedData = $request->validate([
            'id_pesanan' => 'required',
            'id_menu' => 'required',
            'jumlah_menu' => 'required',
            'add_on' => 'nullable',
            'catatan' => 'nullable',
        ]);

        $harga_satuan = Menu::query()->findOrFail($request->id_menu)->harga_menu;
        
        if (!array_key_exists('add_on', $validatedData) || is_null($validatedData['add_on'])) {
            $validatedData['add_on'] = ['Lengkap'];
        }
        
        if (array_key_exists('add_on', $validatedData)) {
            $validatedData['add_on'] = json_encode($validatedData['add_on']);
        }

        $validatedData['harga_satuan'] = $harga_satuan;

        PesananDetail::create($validatedData);

        $pesananDetail = PesananDetail::query()->where('id_pesanan', $validatedData['id_pesanan'])->get();

        $grandtotal = 0;
        foreach ($pesananDetail as &$item) {
            $harga_total = $item->jumlah_menu * $item->harga_satuan;
            $grandtotal += $harga_total;
        }
        
        $pesanan = Pesanan::findOrFail($validatedData['id_pesanan']);
        $pesanan->total_harga = $grandtotal;
        $pesanan->save();

        return redirect('/dashboard/pesanan/'. $validatedData['id_pesanan'])->with('success', 'Menu Pesanan berhasil ditambah');
    }
    
    public function EditDetailPesanan(string $id)
    {
        $model = PesananDetail::query()->findOrFail($id);
        $menu = Menu::all();

        return view('dashboard.pesanan.formMenu',compact('model','menu'));
    }

    public function UpdateDetailPesanan(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_pesanan' => 'required',
            'id_menu' => 'required',
            'jumlah_menu' => 'required',
            'add_on' => 'nullable',
            'catatan' => 'nullable',
        ]);
        
        if (!array_key_exists('add_on', $validatedData) || is_null($validatedData['add_on'])) {
            $validatedData['add_on'] = ['Lengkap'];
        }
        
        if (array_key_exists('add_on', $validatedData)) {
            $validatedData['add_on'] = json_encode($validatedData['add_on']);
        }
        
        PesananDetail::where('id_pesanan_detail', $id)
            ->update($validatedData);

        $pesananDetail = PesananDetail::query()->where('id_pesanan', $validatedData['id_pesanan'])->get();

        $grandtotal = 0;
        foreach ($pesananDetail as &$item) {
            $harga_total = $item->jumlah_menu * $item->harga_satuan;
            $grandtotal += $harga_total;
        }
        
        $pesanan = Pesanan::findOrFail($validatedData['id_pesanan']);
        $pesanan->total_harga = $grandtotal;
        $pesanan->save();

        return redirect('/dashboard/pesanan/'. $validatedData['id_pesanan'])->with('success', 'Menu Pesanan berhasil diubah');
    }

    public function HapusDetailPesanan(string $id)
    {
        $pesananDetail = PesananDetail::find($id);
        $id_pesanan = $pesananDetail->id_pesanan;
        $pesananDetail->delete();

        $pesananDetail = PesananDetail::query()->where('id_pesanan', $id_pesanan)->get();

        $grandtotal = 0;
        foreach ($pesananDetail as &$item) {
            $harga_total = $item->jumlah_menu * $item->harga_satuan;
            $grandtotal += $harga_total;
        }
        
        $pesanan = Pesanan::findOrFail($id_pesanan);
        $pesanan->total_harga = $grandtotal;
        $pesanan->save();

        return redirect('/dashboard/pesanan/'. $id_pesanan)->with('success', 'Menu Pesanan berhasil dihapus');
    }

    public function Create()
    {
        $model = new Pesanan;

        return view('dashboard.pesanan.form',compact('model'));
    }

    public function Store(Request $request)
    {
        $validatedData = $request->validate([
            'nominal' => 'required',
            'sumber' => 'required',
            'tanggal' => 'required',
        ]);
        Pesanan::create($validatedData);

        return redirect('/dashboard/pesanan')->with('success', 'Pendapatan berhasil ditambahkan');
    }

    public function BayarPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_pembayaran = 'Sudah Dibayar';
        $pesanan->save();

        return redirect('/dashboard')->with('success', 'Status pembayaran berhasil diperbarui');
    }
    public function PesananSelesai($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_pesanan = 'Selesai';
        $pesanan->save();

        return redirect('/dashboard')->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function Destroy(string $id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->Details()->delete();
        $pesanan->delete();

        return redirect('/dashboard/pesanan')->with('success', 'Pesanan berhasil dihapus');
    }
}
