@extends('layouts.dashboard')

@section('title')
    <title>
        Dashboard - Data Menu</title>
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Pesanan Baru</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="w-[60%]">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($pesananBaru as $item)
                    <div class="w-fit border-2 border-black">
                        <div class="px-4 pt-4 text-center">No Antri: {{ $item->Antrian->nomor_antrian }}</div>
                        <div class="px-4 text-center">{{ $item->jenis_pesanan }}</div>
                        <div class="px-4 pb-4 uppercase font-semibold text-center">{{ $item->status_pesanan }}</div>
                        <a href="{{ url('/dashboard/pesanan/' . $item->id_pesanan) }}">
                            <div class="flex justify-between items-center px-4 font-semibold border-2">
                                <div>Lihat Detail</div>
                                <div class="flex justify-center items-center w-4 aspect-square rounded-full bg-black"><svg
                                        class="w-2 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path
                                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                    </svg></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
