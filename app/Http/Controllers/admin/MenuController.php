<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;


class MenuController extends Controller
{
    public function Index()
    {
        $data = Menu::all();

        return view('dashboard.menu.index',compact('data'));
    }

    public function Create()
    {
        $model = new Menu;

        return view('dashboard.menu.form',compact('model'));
    }

    public function Store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_menu' => 'required',
            'gambar_menu' => 'required',
            'harga_menu' => 'required',
            'add_on' => '|array',
            'deskripsi_menu' => 'required',
        ]);
        $validatedData['gambar_menu'] = $request->file('gambar_menu')->store('gambar_menu');
        $validatedData['add_on'] = json_encode($validatedData['add_on']);

        Menu::create($validatedData);
    
        return redirect('/dashboard/menu')->with('success', 'Menu berhasil ditambahkan');
    }
    

    public function Edit(string $id)
    {
        $model = Menu::query()->findOrFail($id);

        return view('dashboard.menu.form',compact('model'));
    }

    public function Update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'add_on' => '|array',
            'deskripsi_menu' => 'required',
        ]);

        if ($request->hasFile('gambar_menu')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar_menu'] = $request->file('gambar_menu')->store('gambar_menu');
        } else {
            $validatedData['gambar_menu'] = $request->oldImage;
        }

        $validatedData['add_on'] = json_encode($validatedData['add_on']);

        Menu::where('id_menu', $id)
            ->update($validatedData);

        return redirect('/dashboard/menu')->with('success', 'Menu berhasil diubah');
    }

    public function Destroy(string $id)
    {
        $produk = Menu::find($id);
        if (!empty($produk->gambar)) {
            Storage::delete($produk->gambar);
        }
        $produk->delete();
        return redirect('/dashboard/menu')->with('success', 'Menu berhasil dihapus');
    }
}
