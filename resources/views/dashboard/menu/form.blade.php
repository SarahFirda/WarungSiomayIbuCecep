@extends('layouts.dashboard')

@section('title')
    <title>Dashboard - @if ($model->exists)
            Edit
        @else
            Tambah
        @endif Menu
    </title>
@endsection

@section('header')
    <div class="top-0 sticky flex items-center bg-white shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Menu</div>
@endsection

@section('content')
    <div class="p-4">
        <div class="flex justify-center">
            <div class="font-bold text-2xl">
                @if ($model->exists)
                    Edit
                @else
                    Tambah
                @endif Menu
            </div>
        </div>
        <form class="space-y-4" action="{{ $model->exists ? '/dashboard/menu/' . $model->id_menu : '/dashboard/menu' }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method($model->exists ? 'PUT' : 'POST')
            <div class="space-y-2">
                <label class="font-semibold" for="nama">Nama</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="text" name="nama_menu" id="nama_menu"
                        value="{{ old('nama_menu', $model->nama_menu) }}" placeholder="Isikan Nama Menu Makanan"
                        autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="nama">Gambar</label>
                <div>
                    <img class="img-preview h-full"
                        src="{{ $model->gambar_menu !== null ? asset('storage/' . $model->gambar_menu) : '' }}"
                        alt="">
                </div>
                <input type="hidden" name="oldImage" value="{{ $model->gambar_menu }}">
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="file" name="gambar_menu"
                        id="gambar_menu" onchange="previewImage()">
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="nama">Harga</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="number" name="harga_menu" id="harga_menu"
                        value="{{ old('harga_menu', $model->harga_menu) }}" placeholder="Isikan Harga Menu Makanan"
                        autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold">Add On</label>
                <div>
                    <button class="bg-green-500 px-4 py-1 rounded-md text-white" type="button"
                        id="add-input">Tambah</button>
                </div>

                <div class="space-y-4" id="addOnContainer">
                    @if (isset($model) && $model->add_on)
                        @foreach (json_decode($model->add_on) as $index => $addOnValue)
                            <div
                                class="input-wrapper w-full flex bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                                <input class="w-full bg-transparent focus:outline-none" type="text" name="add_on[]"
                                    value="{{ $addOnValue }}" placeholder="Isikan Add On Makanan" autocomplete="off"
                                    required>
                                @if ($index > 0)
                                    <button type="button" class="text-red-500">Hapus</button>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div
                            class="input-wrapper w-full flex bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                            <input class="w-full bg-transparent focus:outline-none" type="text" name="add_on[]"
                                value="{{ old('addOn', $model->add_on) }}" placeholder="Isikan Add On Makanan"
                                autocomplete="off" required>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-2">
                <label class="font-semibold" for="nama">Deskripsi</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <textarea class="w-full bg-transparent focus:outline-none" name="deskripsi_menu" id="deskripsi_menu"
                        placeholder="Isikan Deskripsi Menu Makanan" autocomplete="off" rows="5" required>{{ old('deskripsi_menu', $model->deskripsi_menu) }}</textarea>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('addOnContainer');
            const addButton = document.getElementById('add-input');
            let inputCount = document.querySelectorAll('.input-wrapper').length;

            // Function to handle input deletion
            function handleDelete(inputWrapper) {
                if (inputCount > 1) {
                    container.removeChild(inputWrapper);
                    inputCount--;
                }
            }

            addButton.addEventListener('click', function() {
                const inputWrapper = document.createElement('div');
                inputWrapper.className =
                    'input-wrapper w-full flex bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md';

                const input = document.createElement('input');
                input.className = 'w-full bg-transparent focus:outline-none';
                input.type = 'text';
                input.name = 'add_on[]';
                input.placeholder = 'Isikan Add On Makanan';
                input.autocomplete = 'off';
                input.required = true;

                const deleteButton = document.createElement('button');
                deleteButton.className = 'text-red-500';
                deleteButton.type = 'button';
                deleteButton.textContent = 'Hapus';
                deleteButton.addEventListener('click', function() {
                    handleDelete(inputWrapper);
                });

                inputWrapper.appendChild(input);
                inputWrapper.appendChild(deleteButton);
                container.appendChild(inputWrapper);
                inputCount++;
            });

            // Event delegation for dynamically added delete buttons
            container.addEventListener('click', function(event) {
                if (event.target.classList.contains('text-red-500')) {
                    const inputWrapper = event.target.parentNode;
                    handleDelete(inputWrapper);
                }
            });
        });
    </script>



    <script>
        function previewImage() {
            const image = document.querySelector('#gambar_menu');
            const imgPreview = document.querySelector('.img-preview');

            if (image.files && image.files[0]) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                    imgPreview.classList.remove('h-full');
                    imgPreview.classList.add('h-48');
                }
            } else {
                imgPreview.src = "{{ $model->gambar !== null ? asset('storage/' . $model->gambar) : '' }}";
                imgPreview.classList.remove('h-48');
                imgPreview.classList.add('h-full');
            }
        }
    </script>
@endsection
