@extends('layouts.dashboard')

@section('title')
    <title>Dashboard - @if ($model->exists)
            Edit
        @else
            Tambah
        @endif Pengeluaran
    </title>
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pengeluaran</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="flex justify-center">
            <div class="font-bold text-2xl">
                @if ($model->exists)
                    Edit
                @else
                    Tambah
                @endif Pengeluaran
            </div>
        </div>
        <form class="space-y-4"
            action="{{ $model->exists ? '/dashboard/pengeluaran/' . $model->id_pengeluaran : '/dashboard/pengeluaran' }}"
            method="POST">
            @csrf
            @method($model->exists ? 'PUT' : 'POST')
            <div class="space-y-2">
                <label class="font-semibold" for="nominal">Nominal</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="number" name="nominal_pengeluaran"
                        id="nominal_pengeluaran" value="{{ old('nominal_pengeluaran', $model->nominal_pengeluaran) }}"
                        placeholder="Isikan Nominal" autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="keperluan">Keperluan</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="text" name="keperluan_pengeluaran"
                        id="keperluan_pengeluaran" value="{{ old('keperluan_pengeluaran', $model->keperluan_pengeluaran) }}"
                        placeholder="Isikan Keperluan Pembelanjaan" autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="tanggal">Tanggal</label>
                <div class="w-fit bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="date" name="tanggal_pengeluaran"
                        id="tanggal_pengeluaran" value="{{ old('tanggal_pengeluaran', $model->tanggal_pengeluaran) }}"
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
