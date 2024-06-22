<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Menu</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>


<body>
    <div class="min-h-dvh w-full md:max-w-[480px] bg-white shadow-md mx-auto">
        <nav class="top-0 w-full h-20 flex items-center space-x-4 px-6 bg-white shadow-lg z-10">
            <img class="w-12" src="/assets/logo.jpg" alt="Warung Siomay Ibu Cecep">
            <div class="font-medium text-xl">Warung Siomay Ibu Cecep</div>
        </nav>

        <div class="py-4 pb-20">
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
            <div class="flex items-center space-x-4 px-6 pb-6">
                <a href="/menu"> <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg></a>
                <div class="font-bold text-xl leading-none">Keranjang</div>
            </div>
            @if (empty($pesanan['keranjang']) || count($pesanan['keranjang']) == 0)
                <div class="h-[65vh] w-full flex flex-col space-y-2 justify-center items-center font-semibold text-xl">
                    <svg class="w-14 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M243.1 2.7c11.8 6.1 16.3 20.6 10.2 32.4L171.7 192H404.3L322.7 35.1c-6.1-11.8-1.5-26.3 10.2-32.4s26.2-1.5 32.4 10.2L458.4 192h36.1H544h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H532L476.1 463.5C469 492 443.4 512 414 512H162c-29.4 0-55-20-62.1-48.5L44 240H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8H81.5h36.1L210.7 12.9c6.1-11.8 20.6-16.3 32.4-10.2zM93.5 240l53 211.9c1.8 7.1 8.2 12.1 15.5 12.1H414c7.3 0 13.7-5 15.5-12.1l53-211.9H93.5zM224 312v80c0 13.3-10.7 24-24 24s-24-10.7-24-24V312c0-13.3 10.7-24 24-24s24 10.7 24 24zm64-24c13.3 0 24 10.7 24 24v80c0 13.3-10.7 24-24 24s-24-10.7-24-24V312c0-13.3 10.7-24 24-24zm112 24v80c0 13.3-10.7 24-24 24s-24-10.7-24-24V312c0-13.3 10.7-24 24-24s24 10.7 24 24z" />
                    </svg>
                    <div class="font-medium text-gray-400">Keranjang Kosong</div>
                </div>
            @else
                <div class="grid grid-cols-1 w-full gap-x-4 px-6 gap-y-6">
                    @foreach ($pesanan['keranjang'] as $index => $item)
                        <div class="w-full p-3 rounded-md overflow-hidden border-2 border-black shadow-md">
                            <div class="flex justify-between">
                                <div class="font-bold text-xl">{{ $item['nama_menu'] }}</div>
                                <div class="flex space-x-2">
                                    <a href="{{ url('/keranjang/edit/' . $index) }}" class="text-blue-500">Edit</a>
                                    <div>Jumlah</div>
                                    <div>{{ $item['jumlah_menu'] }}</div>
                                </div>
                            </div>
                            @foreach (json_decode($item['add_on']) as $addOnValue)
                                <div class="text-gray-500 text-sm">{{ $addOnValue }}</div>
                            @endforeach
                            <div class="font-semibold pt-4">Catatan:</div>
                            <div class="text-gray-500 text-sm">
                                {{ isset($item['catatan']) ? $item['catatan'] : 'Tidak ada catatan' }}</div>
                            <div class="flex justify-between items-center">
                                <div class="font-semibold text-xl pt-2">
                                    Rp.{{ number_format($item['harga_menu'], 0, ',', '.') }}
                                </div>
                                <a href="{{ url('/keranjang/hapus/' . $index) }}" class="text-red-500">Hapus</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (count($keranjang) !== 0)
                <div class="bottom-0 fixed w-full md:max-w-[480px] py-4 space-y-3 bg-white shadow-md border-t-4">
                    <div class="w-full px-6">
                        <div id="pilihPembayaranBtn"
                            class="w-full flex justify-between p-2 rounded-md border-2 text-left border-gray-300 font-medium text-black cursor-pointer">
                            <div>
                                {{ isset($pesanan['opsi_pembayaran']) ? 'Pembayaran: ' . $pesanan['opsi_pembayaran'] : 'Pilih Pembayaran' }}
                            </div>
                            <svg class="w-3 fill-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path
                                    d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                            </svg>
                        </div>

                    </div>
                    <div class="flex w-full h-full justify-between items-center px-6">
                        <div class="space-y-2">
                            @php
                                $countKeranjang = count($keranjang);
                            @endphp
                            <div class="font-medium leading-none">{{ $countKeranjang }}
                                {{ $countKeranjang > 1 ? 'items' : 'item' }}</div>
                            <div class="font-bold text-lg leading-none">
                                Rp.{{ number_format($pesanan['total_harga'], 0, ',', '.') }}</div>
                        </div>
                        <div>
                            @if ($pesanan['opsi_pembayaran'] == null)
                                <button disabled id="pay-button"
                                    class="flex items-center space-x-3 px-14 py-2 rounded-md bg-[#ae0001] disabled:bg-[#ae0001]/50">
                                    <div class="font-semibold text-white text-lg">Bayar</div>
                                </button>
                            @elseif ($pesanan['opsi_pembayaran'] == 'Bayar Ditempat')
                                <a href="{{ url('/pesanan') }}" id="pay-button"
                                    class="flex items-center space-x-3 px-14 py-2 rounded-md bg-[#ae0001]">
                                    <div class="font-semibold text-white text-lg">Pesan</div>
                                </a>
                            @else
                                <button id="pay-button"
                                    class="flex items-center space-x-3 px-14 py-2 rounded-md bg-[#ae0001]">
                                    <div class="font-semibold text-white text-lg">Transfer</div>
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            @endif

            <div id="modalContainer"
                class="fixed max-w-[480px] mx-auto inset-0 z-50 overflow-hidden bg-black bg-opacity-50 flex justify-center items-end hidden">
                <div id="modalContent" class="modal w-full bg-white pb-6 rounded-t-lg">
                    <div class="flex items-center space-x-4 p-6 pb-4 border-b-8">
                        <svg id="closeModalBtn" class="w-3 hover:fill-red-500 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                        </svg>
                        <div class="font-semibold text-xl leading-none">Opsi Pembayaran</div>
                    </div>
                    <a href="{{ url('/bayar/ditempat') }}">
                        <div class="px-4 py-4 border-b-2 font-semibold hover:bg-gray-100 cursor-pointer">
                            Bayar Ditempat
                        </div>
                    </a>
                    <a href="{{ url('/bayar/transfer') }}">
                        <div class="px-4 py-4 border-b-2 font-semibold hover:bg-gray-100 cursor-pointer">
                            Transfer
                        </div>
                    </a>
                </div>
            </div>
        </div>
</body>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                window.location.href = "/pesanan"
                // alert("payment success!");
                // console.log(result);
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                console.log(result);

            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                console.log(result);
            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        })
    });
</script>

<script>
    const pilihPembayaranBtn = document.getElementById('pilihPembayaranBtn');
    const modalContainer = document.getElementById('modalContainer');
    const modalContent = document.getElementById('modalContent');
    const closeModalBtn = document.getElementById('closeModalBtn');

    pilihPembayaranBtn.addEventListener('click', () => {
        modalContainer.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.add('open');
        }, 100);
    });

    closeModalBtn.addEventListener('click', () => {
        modalContent.classList.remove('open');
        setTimeout(() => {
            modalContainer.classList.add('hidden');
        }, 200);
    });
</script>

</html>
