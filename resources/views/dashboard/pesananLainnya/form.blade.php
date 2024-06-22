@extends('layouts.dashboard')

@section('title')
    <title>Dashboard - @if ($model->exists)
            Edit
        @else
            Tambah
        @endif Pesanan Lainnya
    </title>
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pesanan Lainnya</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="flex justify-center">
            <div class="font-bold text-2xl">
                @if ($model->exists)
                    Edit
                @else
                    Tambah
                @endif Pesanan Lainnya
            </div>
        </div>
        <form class="space-y-4"
            action="{{ $model->exists ? '/dashboard/pesanan-lainnya/' . $model->id_pesanan_lainnya : '/dashboard/pesanan-lainnya' }}"
            method="POST">
            @csrf
            @method($model->exists ? 'PUT' : 'POST')
            <div class="space-y-2">
                <label class="font-semibold" for="nominal">Nominal</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="number" name="nominal_lainnya"
                        id="nominal_lainnya" value="{{ old('nominal_lainnya', $model->nominal_lainnya) }}"
                        placeholder="Isikan Nominal" autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="sumber">Sumber</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="text" name="sumber_lainnya"
                        id="sumber_lainnya" value="{{ old('sumber_lainnya', $model->sumber_lainnya) }}"
                        placeholder="Isikan Sumber Pendapatan" autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="tanggal">Tanggal</label>
                <div class="w-fit bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="date" name="tanggal_lainnya"
                        id="tanggal_lainnya" value="{{ old('tanggal_lainnya', $model->tanggal_lainnya) }}"
                        autocomplete="off" required>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 font-medium text-white px-6 py-2 rounded-lg">
                    @if ($model->exists)
                        Selesai
                    @else
                        Tambah
                    @endif
                </button>
            </div>
        </form>
    </div>
@endsection
