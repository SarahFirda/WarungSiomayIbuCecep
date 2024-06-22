@extends('layouts.dashboard')

@section('title')
    <title>Dashboard - Pesanan</title>
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pesanan</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="relative flex justify-center items-center pb-4">
            <div class="font-bold text-2xl">Pesanan</div>
            <div class="absolute right-0">
                {{-- <a class="font-medium text-white bg-green-500 px-6 py-2 rounded-lg"
                    href="/dashboard/pendapatan/create">Tambah</a> --}}
            </div>
        </div>

        <div>
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">Status</th>
                        <th class="py-2 px-4 border-2 border-black">No Antri</th>
                        <th class="py-2 px-4 border-2 border-black">Dibuat</th>
                        <th class="py-2 px-4 border-2 border-black">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data) && count($data) !== 0)
                        @foreach ($data as $item)
                            <tr class="text-black text-center border-2 border-black">
                                <td class="border-2 border-black">
                                    {{ $item->status_pembayaran }}
                                </td>
                                <td class="w-[20%] border-2 border-black">{{ $item->Antrian->nomor_antrian }}</td>
                                <td class="w-[30%] border-2 border-black py-2">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/y') }}
                                </td>
                                <td class="w-[30%] border-2 border-black py-2">
                                    <div class="flex justify-center space-x-2">
                                        <a class="bg-gray-300 px-4 py-1 rounded-md text-white"
                                            href="{{ url('/dashboard/pesanan/' . $item->id_pesanan) }}">Detail</a>
                                        <form action="/dashboard/pesanan/{{ $item->id_pesanan }}" method="post"
                                            onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            @csrf
                                            @method('delete')
                                            <button class="bg-red-500 px-4 py-1 rounded-md text-white">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Pesanan Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
