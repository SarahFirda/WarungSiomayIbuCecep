@extends('layouts.dashboard')

@section('title')
    <title>
        Dashboard - Data Menu</title>
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Pesanan Selesai</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="w-[60%]">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($pesananSelesai as $item)
                    <div class="w-fit border-2 border-black p-4">
                        <div class="text-center">No Antri: {{ $item->Antrian->nomor_antrian }}</div>
                        <div class="text-center">{{ $item->jenis_pesanan }}</div>
                        <div class="uppercase font-semibold text-center">{{ $item->status_pesanan }}</div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
