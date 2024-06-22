<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Menu</title>
</head>

<body>
    <div class="w-full min-h-dvh md:max-w-[480px] bg-white shadow-md mx-auto">
        <nav class="top-0 w-full h-20 flex items-center space-x-4 px-6 bg-white shadow-lg z-10">
            <img class="w-12" src="/assets/logo.jpg" alt="Warung Siomay Ibu Cecep">
            <div class="font-medium text-xl">Warung Siomay Ibu Cecep</div>
        </nav>

        <div class="px-6 py-4 pb-24">
            <?php if($antrian == null): ?>
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
            <?php endif; ?>
            <div class="font-semibold text-3xl pb-4">Menu</div>
            <?php if(count($data) !== 0): ?>
                <div class="grid grid-cols-1 w-full gap-x-4 gap-y-6">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-full rounded-xl overflow-hidden shadow-md">
                            <div class="relative aspect-[6/4] overflow-hidden">
                                <img class="w-full h-full object-cover <?php echo e($item->stok_menu == 0 ? 'grayscale' : 'grayscale-0'); ?>"
                                    src="<?php echo e(asset('storage/' . $item->gambar_menu)); ?>" alt="menu image">
                            </div>
                            <div class="">
                                <div class="py-2 px-4">
                                    <div class="font-bold text-xl"><?php echo e($item->nama_menu); ?></div>
                                    <div class="text-sm text-justify text-gray-500"><?php echo e($item->deskripsi_menu); ?>

                                    </div>
                                    <div class="font-bold text-xl py-3">
                                        Rp.<?php echo e(number_format($item->harga_menu, 0, ',', '.')); ?>

                                    </div>
                                    <div class="flex justify-center py-1">
                                        <?php if($item->stok_menu == 0): ?>
                                            <button
                                                class="w-full font-semibold text-center py-2 rounded-lg text-white bg-gray-300"
                                                disabled>
                                                Habis
                                            </button>
                                        <?php else: ?>
                                            <a href="/menu/<?php echo e($item->id_menu); ?>"
                                                class="w-full font-semibold text-center text-white py-2 rounded-lg bg-[#ae0001]">
                                                + Keranjang
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div
                    class="fixed md:max-w-[480px] mx-auto inset-0 z-50 overflow-auto flex flex-col justify-center items-center space-y-2">
                    <svg class="w-14 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm96 64a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm104 0c0-13.3 10.7-24 24-24h96c13.3 0 24 10.7 24 24s-10.7 24-24 24H224c-13.3 0-24-10.7-24-24zm0 96c0-13.3 10.7-24 24-24h96c13.3 0 24 10.7 24 24s-10.7 24-24 24H224c-13.3 0-24-10.7-24-24zm0 96c0-13.3 10.7-24 24-24h96c13.3 0 24 10.7 24 24s-10.7 24-24 24H224c-13.3 0-24-10.7-24-24zm-72-64a32 32 0 1 1 0-64 32 32 0 1 1 0 64zM96 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                    </svg>
                    <div class="font-semibold text-gray-400">Data Menu Kosong</div>
                </div>
            <?php endif; ?>


        </div>

        <?php if(count($keranjang) !== 0 && !empty($pesanan)): ?>
            <div class="bottom-0 fixed w-full md:max-w-[480px] py-4 bg-white shadow-md border-t-4">
                <div class="flex w-full h-full justify-between items-center px-6">
                    <div class="space-y-2">
                        <?php
                            $countKeranjang = count($keranjang);
                        ?>
                        <div class="font-medium leading-none"><?php echo e($countKeranjang); ?>

                            <?php echo e($countKeranjang > 1 ? 'items' : 'item'); ?></div>
                        <div class="font-bold text-lg leading-none">
                            Rp.<?php echo e(number_format($pesanan['total_harga'], 0, ',', '.')); ?></div>
                    </div>
                    <div>
                        <a href="/keranjang" class="flex items-center space-x-3 px-6 py-2 rounded-md bg-[#ae0001]">
                            <svg class="w-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path
                                    d="M243.1 2.7c11.8 6.1 16.3 20.6 10.2 32.4L171.7 192H404.3L322.7 35.1c-6.1-11.8-1.5-26.3 10.2-32.4s26.2-1.5 32.4 10.2L458.4 192h36.1H544h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H532L476.1 463.5C469 492 443.4 512 414 512H162c-29.4 0-55-20-62.1-48.5L44 240H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8H81.5h36.1L210.7 12.9c6.1-11.8 20.6-16.3 32.4-10.2zM93.5 240l53 211.9c1.8 7.1 8.2 12.1 15.5 12.1H414c7.3 0 13.7-5 15.5-12.1l53-211.9H93.5zM224 312v80c0 13.3-10.7 24-24 24s-24-10.7-24-24V312c0-13.3 10.7-24 24-24s24 10.7 24 24zm64-24c13.3 0 24 10.7 24 24v80c0 13.3-10.7 24-24 24s-24-10.7-24-24V312c0-13.3 10.7-24 24-24zm112 24v80c0 13.3-10.7 24-24 24s-24-10.7-24-24V312c0-13.3 10.7-24 24-24s24 10.7 24 24z" />
                            </svg>
                            <div class="font-semibold text-white text-lg">Keranjang</div>
                        </a>

                    </div>

                </div>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\e-menu\resources\views/menu/index.blade.php ENDPATH**/ ?>