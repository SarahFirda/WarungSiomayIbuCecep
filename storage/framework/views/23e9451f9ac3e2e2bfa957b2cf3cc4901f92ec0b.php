

<?php $__env->startSection('title'); ?>
    <title>
        Dashboard - Data Menu</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Pesanan Selesai</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="w-[60%]">
            <div class="grid grid-cols-2 gap-4">
                <?php $__currentLoopData = $pesananSelesai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-fit border-2 border-black p-4">
                        <div class="text-center">No Antri: <?php echo e($item->Antrian->nomor_antrian); ?></div>
                        <div class="text-center"><?php echo e($item->jenis_pesanan); ?></div>
                        <div class="uppercase font-semibold text-center"><?php echo e($item->status_pesanan); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/pesananselesai/index.blade.php ENDPATH**/ ?>