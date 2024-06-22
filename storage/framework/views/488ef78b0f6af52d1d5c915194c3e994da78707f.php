

<?php $__env->startSection('title'); ?>
    <title>Dashboard - Rating</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Rating</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="relative flex justify-center items-center pb-4">
            <div class="font-bold text-2xl">Rating</div>
        </div>

        <div>
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">Nama Menu</th>
                        <th class="py-2 px-4 border-2 border-black">Penilaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPembelanjaan = 0;
                    ?>

                    <?php if(isset($data) && count($data) !== 0): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-black text-center border-2 border-black">
                                <td class="border-2 border-black font-semibold text-lg py-2">
                                    <?php echo e($item->Menu->nama_menu); ?>

                                </td>
                                <td class="border-2 border-black">
                                    <div class="flex justify-center font-semibold text-lg">
                                        <svg class="w-5 fill-yellow-500" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 576 512">
                                            <path
                                                d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                        </svg>
                                        <div class="pl-2"><?php echo e(number_format($item->rata_rata, 1, '.', ',')); ?> / 5</div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Rating Kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-menu\resources\views/dashboard/rating/index.blade.php ENDPATH**/ ?>