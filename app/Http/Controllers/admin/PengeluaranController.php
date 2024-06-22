<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    public function Index()
    {
        $data = Pengeluaran::all();
        return view('dashboard.pengeluaran.index',compact('data'));
    }

    public function Create()
    {
        $model = new Pengeluaran;
        return view('dashboard.pengeluaran.form',compact('model'));
    }

    public function Store(Request $request)
    {
        $validatedData = $request->validate([
            'nominal_pengeluaran' => 'required',
            'keperluan_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required',
        ]);
        Pengeluaran::create($validatedData);

        return redirect('/dashboard/pengeluaran')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function Edit(string $id)
    {
        $model = Pengeluaran::query()->findOrFail($id);
        return view('dashboard.pengeluaran.form',compact('model'));
    }

    public function Update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nominal_pengeluaran' => 'required',
            'keperluan_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required',
        ]);
        Pengeluaran::where('id_pengeluaran', $id)
            ->update($validatedData);

        return redirect('/dashboard/pengeluaran')->with('success', 'Pengeluaran berhasil diubah');
    }

    public function Destroy(string $id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect('/dashboard/pengeluaran')->with('success', 'Pembelanjaan Luar berhasil dihapus');
    }
}
