@extends('layouts.dashboard')

@section('title')
    <title>Dashboard - Data Menu</title>
    @livewireStyles
    @livewireScripts
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Menu</div>
@endsection


@section('content')
    <div class="p-4">
        <div class="relative flex justify-center items-center pb-4">
            <div class="font-bold uppercase text-2xl">menu</div>
            <div class="absolute right-0">
                <a class="font-medium text-white bg-green-500 px-6 py-2 rounded-lg" href="/dashboard/menu/create">Tambah</a>
            </div>
        </div>

        <div>
            <table class="w-full rounded-xl">
                <tr class="text-black text-center border-2 border-black">
                    <th class="py-2 border-2 border-black">Gambar</th>
                    <th class="py-2 border-2 border-black">Nama</th>
                    <th class="py-2 border-2 border-black">Harga</th>
                    <th class="py-2 border-2 border-black">Action</th>
                </tr>
                @if (count($data) !== 0)
                    @foreach ($data as $item)
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-[20%] border-2 border-black">
                                <img class="w-full p-4" src="{{ asset('storage/' . $item->gambar_menu) }}" alt="">
                            </td>
                            <td class="border-2 border-black">{{ $item->nama_menu }}</td>
                            <td class="border-2 border-black">Rp.{{ number_format($item->harga_menu, 0, ',', '.') }}</td>
                            <td class="w-[30%] border-2 border-black py-2">
                                <div class="space-y-4 space-x-2">
                                    <div class="flex justify-center space-x-2">
                                        <a class="bg-yellow-500 px-4 py-1 rounded-md text-white"
                                            href="/dashboard/menu/{{ $item->id_menu }}/edit">Edit</a>
                                        <form action="/dashboard/menu/{{ $item->id_menu }}" method="post"
                                            onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            @csrf
                                            @method('delete')
                                            <button class="bg-red-500 px-4 py-1 rounded-md text-white">Hapus</button>
                                        </form>
                                    </div>
                                    <div>
                                        <livewire:toggle-switch :model="$item" field="stok_menu"
                                            key="{{ $item->id_menu }}" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-black text-center border-2 border-black">
                        <td class="w-full border-2 border-black py-12" colspan="4">Data Menu Kosong</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
