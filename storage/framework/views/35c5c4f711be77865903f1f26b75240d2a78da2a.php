<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#D9BD8E">
    <meta name="msapplication-navbutton-color" content="#D9BD8E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#D9BD8E">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <title>List Pesanan</title>
</head>

<body>
    <div class="min-h-screen w-full md:max-w-[480px] bg-white shadow-md mx-auto">
        <nav class="top-0 w-full h-20 flex items-center space-x-4 px-6 bg-white shadow-lg z-10">
            <img class="w-12" src="/assets/logo.jpg" alt="Warung Siomay Ibu Cecep">
            <div class="font-medium text-xl">Warung Siomay Ibu Cecep</div>
        </nav>

        <div class="px-6 py-4 pb-20">
            <div class="font-semibold text-3xl pb-4">List Pesanan</div>

            <div>
                <div class="flex justify-between items-center px-2 border-2 border-b-0 border-black">
                    <div class="font-bold text-lg">No Antri: <?php echo e($pesanan->Antrian->nomor_antrian); ?></div>
                    <div class="font-bold text-lg"><?php echo e($pesanan->jenis_pesanan); ?></div>
                </div>
                <?php $__currentLoopData = $pesanan_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-between p-2 border-2 border-b-0 border-black">
                        <div class="flex flex-col w-[40%]">
                            <div class="font-medium text-lg"><?php echo e($item->Menu->nama_menu); ?></div>
                            <?php $__currentLoopData = json_decode($item->add_on); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addOnValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-sm"><?php echo e($addOnValue); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="font-bold text-center w-[20%]"><?php echo e($item->jumlah_menu); ?></div>
                        <div class="font-semibold w-[40%] text-right">
                            Rp.<?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="flex justify-center py-4 border-2 border-black font-bold">
                    Total Harga: Rp.<?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?>

                </div>
            </div>
            <div class="pt-2 font-medium">
                <div>Bagaimana dengan makanannya?</div>
                <div>Rating disini!</div>
            </div>
            <div>
                <?php if($ratings->isEmpty()): ?>
                    <form class="" action="<?php echo e('/rating/' . $pesanan->id_pesanan); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php $__currentLoopData = $pesanan_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex">
                                <div class="w-full flex items-center">
                                    <div class="font-semibold text-xl w-[25%]"><?php echo e($item->Menu->nama_menu); ?></div>
                                    <div class="font-semibold text-xl w-[5%]">:</div>
                                    <div class="">
                                        <input class="star star-5" value="5" id="star-5-<?php echo e($index); ?>"
                                            type="radio" name="ratings[<?php echo e($item->id_pesanan_detail); ?>]" />
                                        <label class="star star-5" for="star-5-<?php echo e($index); ?>"></label>
                                        <input class="star star-4" value="4" id="star-4-<?php echo e($index); ?>"
                                            type="radio" name="ratings[<?php echo e($item->id_pesanan_detail); ?>]" />
                                        <label class="star star-4" for="star-4-<?php echo e($index); ?>"></label>
                                        <input class="star star-3" value="3" id="star-3-<?php echo e($index); ?>"
                                            type="radio" name="ratings[<?php echo e($item->id_pesanan_detail); ?>]" />
                                        <label class="star star-3" for="star-3-<?php echo e($index); ?>"></label>
                                        <input class="star star-2" value="2" id="star-2-<?php echo e($index); ?>"
                                            type="radio" name="ratings[<?php echo e($item->id_pesanan_detail); ?>]" />
                                        <label class="star star-2" for="star-2-<?php echo e($index); ?>"></label>
                                        <input class="star star-1" value="1" id="star-1-<?php echo e($index); ?>"
                                            type="radio" name="ratings[<?php echo e($item->id_pesanan_detail); ?>]" />
                                        <label class="star star-1" for="star-1-<?php echo e($index); ?>"></label>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-center pt-8">
                            <button type="submit"
                                class="bg-[#ae0001] font-semibold text-white px-16 py-2 rounded-md">Kirim</button>
                        </div>
                    </form>
                <?php else: ?>
                    <div>
                        <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex">
                                <div class="w-full flex items-center">
                                    <div class="font-semibold text-xl w-[25%]"><?php echo e($item->Menu->nama_menu); ?></div>
                                    <div class="font-semibold text-xl w-[5%]">:</div>
                                    <div>
                                        <?php for($i = 1; $i <= $item->rating; $i++): ?>
                                            <input class="star star-5" type="radio" checked />
                                            <label class="star star-5"></label>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</body>

<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }

    setTimeout("preventBack()", 0);

    window.onunload = function() {
        null
    };
</script>

</html>
<?php /**PATH E:\Project\sarah\e-menu\resources\views/pesanan.blade.php ENDPATH**/ ?>