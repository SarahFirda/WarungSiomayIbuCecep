<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesananLainnya;
use Illuminate\Http\Request;

class PesananLainnyaController extends Controller
{
    public function Index()
    {
        $data = PesananLainnya::all();

        return view('dashboard.pesananLainnya.index',compact('data'));
    }

    public function Create()
    {
        $model = new PesananLainnya;

        return view('dashboard.pesananLainnya.form',compact('model'));
    }

    public function Store(Request $request)
    {
        $validatedData = $request->validate([
            'nominal_lainnya' => 'required',
            'sumber_lainnya' => 'required',
            'tanggal_lainnya' => 'required',
        ]);
        PesananLainnya::create($validatedData);

        return redirect('/dashboard/pesanan-lainnya')->with('success', 'Pesanan Luar berhasil ditambahkan');
    }

    public function Edit(string $id)
    {
        $model = PesananLainnya::query()->findOrFail($id);

        return view('dashboard.pesananLainnya.form',compact('model'));
    }

    public function Update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nominal_lainnya' => 'required',
            'sumber_lainnya' => 'required',
            'tanggal_lainnya' => 'required',
        ]);
        PesananLainnya::where('id_pesanan_lainnya', $id)
            ->update($validatedData);

        return redirect('/dashboard/pesanan-lainnya')->with('success', 'Pesanan Luar berhasil diubah');
    }

    public function Destroy(string $id)
    {
        $pesananLainnya = PesananLainnya::find($id);
        $pesananLainnya->delete();

        return redirect('/dashboard/pesanan-lainnya')->with('success', 'Pesanan Luar berhasil dihapus');
    }
}
