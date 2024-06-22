@extends('layouts.dashboard')

@section('title')
    <title>Dashboard - Pengeluaran</title>
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pengeluaran</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="relative flex justify-center items-center pb-4">
            <div class="font-bold text-2xl">Pengeluaran</div>
            <div class="absolute right-0">
                <a class="font-medium text-white bg-green-500 px-6 py-2 rounded-lg"
                    href="/dashboard/pengeluaran/create">Tambah</a>
            </div>
        </div>

        <div>
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">Nominal</th>
                        <th class="py-2 px-4 border-2 border-black">Keperluan</th>
                        <th class="py-2 px-4 border-2 border-black">Tanggal</th>
                        <th class="py-2 px-4 border-2 border-black">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPengeluaran = 0;
                    @endphp

                    @if (isset($data) && count($data) !== 0)
                        @foreach ($data as $item)
                            @php
                                $totalPengeluaran += $item->nominal_pengeluaran;
                            @endphp
                            <tr class="text-black text-center border-2 border-black">
                                <td class="w-[20%] border-2 border-black">
                                    Rp.{{ number_format($item->nominal_pengeluaran, 0, ',', '.') }}
                                </td>
                                <td class="border-2 border-black">{{ $item->keperluan_pengeluaran }}</td>
                                <td class="border-2 border-black">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/y') }}
                                </td>
                                <td class="w-[30%] border-2 border-black py-2">
                                    <div class="flex justify-center space-x-2">
                                        <a class="bg-yellow-500 px-4 py-1 rounded-md text-white"
                                            href="/dashboard/pengeluaran/{{ $item->id_pengeluaran }}/edit">Edit</a>
                                        <form action="/dashboard/pengeluaran/{{ $item->id_pengeluaran }}" method="post"
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
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Pengeluaran Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="font-bold text-lg pt-4">Total Pengeluaran:
                Rp.{{ isset($data) && count($data) !== 0 ? number_format($totalPengeluaran, 0, ',', '.') : 0 }}
            </div>
        </div>
    </div>
@endsection
