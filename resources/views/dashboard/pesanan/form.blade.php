@extends('layouts.dashboard')

@section('title')
    <title>Dashboard - @if ($model->exists)
            Edit
        @else
            Tambah
        @endif Pendapatan Luar
    </title>
@endsection

@section('header')
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pendapatan Luar</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="flex justify-center">
            <div class="font-bold text-2xl">
                @if ($model->exists)
                    Edit
                @else
                    Tambah
                @endif Pendapatan Luar
            </div>
        </div>
        <form class="space-y-4"
            action="{{ $model->exists ? '/dashboard/pendapatan/' . $model->id : '/dashboard/pendapatan' }}" method="POST">
            @csrf
            @method($model->exists ? 'PUT' : 'POST')
            <div class="space-y-2">
                <label class="font-semibold" for="nominal">Nominal</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="number" name="nominal" id="nominal"
                        value="{{ old('nominal', $model->nominal) }}" placeholder="Isikan Nominal" autocomplete="off"
                        required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="sumber">Sumber</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="text" name="sumber" id="sumber"
                        value="{{ old('sumber', $model->sumber) }}" placeholder="Isikan Sumber Pendapatan"
                        autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="tanggal">Tanggal</label>
                <div class="w-fit bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="date" name="tanggal" id="tanggal"
                        value="{{ old('tanggal', $model->tanggal) }}" autocomplete="off" required>
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
