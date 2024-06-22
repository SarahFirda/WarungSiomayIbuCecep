<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Menu</title>
</head>

<body>
    <div class="min-h-dvh w-full md:max-w-[480px] bg-white shadow-md mx-auto">
        <nav class="top-0 w-full h-20 flex items-center space-x-4 px-6 bg-white shadow-lg z-10">
            <img class="w-12" src="/assets/logo.jpg" alt="Warung Siomay Ibu Cecep">
            <div class="font-medium text-xl">Warung Siomay Ibu Cecep</div>
        </nav>

        <div class="py-4 pb-24">
            @if ($antrian == null)
                <div
                    class="fixed md:max-w-[480px] mx-auto inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center px-8">
                    <div class="bg-white rounded-lg overflow-hidden">
                        <div class="px-4 py-2 bg-[#ae0001] font-semibold text-white text-center">Pemberitahuan</div>
                        <div class="flex flex-col items-center p-6 space-y-4">
                            <div class="text-center text-gray-500">Anda belum mempunyai antrian, silahkan
                                mengambil
                                antrian terlebih dahulu untuk melanjutkan pemesanan
                            </div>
                            <a class="bg-[#ae0001] text-center px-8 py-2 rounded-md text-white" href="/antrian">
                                Ambil Antrian
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="flex items-center space-x-4 px-4 pb-6">
                <a href="/menu"> <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg></a>
                <div class="font-bold text-xl leading-none">Kustomisasi Pesanan</div>
            </div>
            <div class="space-y-2">
                <div class="px-4 pb-4 space-y-4 border-b-[6px]">
                    <div class="flex justify-between">
                        <div class="font-bold text-lg">{{ $data->nama_menu }}</div>
                        <div class="font-bold text-lg">Rp.{{ number_format($data->harga_menu, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center space-x-2 px-4 pb-2">
                        <div class="font-semibold">Add on</div>
                        {{-- <div id="errorMessage" class="text-red-500 text-xs mt-1"></div> --}}
                    </div>
                    <form action="/keranjang/{{ $data->id_menu }}" method="POST" id="checkboxForm">
                        @csrf
                        <div class="px-4 space-y-2" id="checkboxContainer">
                            @foreach (json_decode($data->add_on) as $index => $addOnValue)
                                <label for="checkbox{{ $index + 1 }}"
                                    class="flex items-center space-x-4 pb-2 {{ $loop->last ? '' : 'border-b-2' }} ">
                                    <input type="checkbox" id="checkbox{{ $index + 1 }}" name="add_on[]"
                                        value="{{ $addOnValue }}" hidden>
                                    <svg class="w-4 fill-gray-500 checked-svg" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M384 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H384zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z" />
                                    </svg>
                                    <div id="checkboxText{{ $index + 1 }}" class="text-gray-500">{{ $addOnValue }}
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="space-y-4 border-t-[6px]">
                            <div class="px-4 pt-2 font-semibold">Catatan</div>
                            <div class="px-4">
                                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                                    <textarea class="w-full bg-transparent text-sm focus:outline-none" name="catatan" id="catatan"
                                        placeholder="Catatan Makanan (Opsional)" autocomplete="off" rows="5">{{ old('catatan') }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div
                            class="bottom-0 fixed w-full md:max-w-[480px] bg-white py-3 space-y-3 border-t-4 shadow-md px-6">
                            <div class="flex justify-between">
                                <div class="font-semibold">Jumlah</div>
                                <div class="flex items-center space-x-2">
                                    <button type="button" onclick="decrementValue()"
                                        class="flex w-6 justify-center items-center aspect-square border-2 border-[#ae0001] rounded-md">
                                        <svg class="w-2 [#e5e7eb] fill-[#ae0001]" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                                        </svg>
                                    </button>
                                    <div class="w-10">
                                        <input class="w-full text-lg leading-none text-center" type="number"
                                            name="jumlah_menu" id="jumlah_menu" value="1" min="1"
                                            max="999">
                                    </div>
                                    <button type="button" onclick="incrementValue()"
                                        class="flex w-6 justify-center items-center aspect-square border-2 border-[#ae0001] rounded-md">
                                        <svg class="w-2 fill-[#ae0001]" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-center items-center ">
                                <button type="submit" class="w-full text-white bg-[#ae0001] px-4 py-2 rounded-lg">
                                    Tambahkan ke Keranjang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function incrementValue() {
        var value = parseInt(document.getElementById('jumlah_menu').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('jumlah_menu').value = value;
        document.querySelector('button[onclick="decrementValue()"]').removeAttribute('disabled');
    }

    function decrementValue() {
        var value = parseInt(document.getElementById('jumlah_menu').value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            document.getElementById('jumlah_menu').value = value;
            if (value === 1) {
                document.querySelector('button[onclick="decrementValue()"]').setAttribute('disabled', 'disabled');
            }
        }
    }

    const form = document.getElementById('checkboxForm');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function() {
            const checkboxText = this.parentElement.querySelector('.text-gray-500');

            if (this.checked) {
                checkboxText.classList.add('font-semibold');
            } else {
                checkboxText.classList.remove('font-semibold');
            }

            const svg = this.parentElement.querySelector('.checked-svg');

            if (this.checked) {
                svg.innerHTML =
                    '<path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>';
            } else {
                svg.innerHTML =
                    '<path d="M384 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H384zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/>';
            }

            if (this.checked) {
                svg.classList.remove('fill-gray-500');
                svg.classList.add('fill-green-500');
            } else {
                svg.classList.add('fill-gray-500');
                svg.classList.remove('fill-green-500');
            }
        });
    });
</script>

</html>
