

<?php $__env->startSection('title'); ?>
    <title>
        Dashboard - Data Menu</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Pesanan Belum Dibayar</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="w-[60%]">
            <div class="grid grid-cols-2 gap-4">
                <?php $__currentLoopData = $pesananBelumBayar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-fit border-2 border-black">
                        <div class="px-4 pt-4 text-center">No Antri: <?php echo e($item->Antrian->nomor_antrian); ?></div>
                        <div class="px-4 text-center"><?php echo e($item->jenis_pesanan); ?></div>
                        <div class="px-4 pb-4 uppercase font-semibold text-center">Sudah Bayar?</div>
                        <a href="<?php echo e(url('/dashboard/pesanan/' . $item->id_pesanan)); ?>">
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/pesananbelumbayar/index.blade.php ENDPATH**/ ?>