@extends('layouts.dashboard')
@livewireStyles

@section('title')
    <title>Dashboard - @if ($model->exists)
            Edit
        @else
            Tambah
        @endif Menu Pesanan
    </title>
@endsection

@section('header')
    <div class="top-0 sticky flex items-center bg-white shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Menu Pesanan
    </div>
@endsection

@section('content')
    <div class="p-4">
        <div class="flex justify-center">
            <div class="font-bold text-2xl">
                @if ($model->exists)
                    Edit
                @else
                    Tambah
                @endif Menu Pesanan
            </div>
        </div>
        <form class="space-y-4"
            action="{{ $model->exists ? '/dashboard/pesanan/edit/' . $model->id_pesanan_detail : '/dashboard/pesanan/tambah' }}"
            method="POST">
            @csrf
            @method($model->exists ? 'PUT' : 'POST')
            <input hidden name="id_pesanan" id="id_pesanan" value="{{ $model->exists ? $model->id_pesanan : $id_pesanan }}">

            <livewire:select-option :pesananData="$model" />

            <div class="space-y-2">
                <label class="font-semibold" for="nama">Jumlah Menu</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="number" name="jumlah_menu"
                        id="jumlah_menu" value="{{ old('jumlah_menu', $model->jumlah_menu) }}"
                        placeholder="Isikan Jumlah Menu Makanan" autocomplete="off" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="font-semibold" for="nama">Catatan</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <textarea class="w-full bg-transparent focus:outline-none" name="catatan" id="catatan"
                        placeholder="Isikan Catatan Makanan (Optional)" autocomplete="off" rows="5">{{ old('catatan', $model->deskripsi_menu) }}</textarea>
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

@livewireScripts
