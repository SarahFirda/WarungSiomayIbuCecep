

<?php $__env->startSection('title'); ?>
    <title>Dashboard - Pesanan Lainnya</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pesanan Lainnya</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="relative flex justify-center items-center pb-4">
            <div class="font-bold text-2xl">Pesanan Lainnya</div>
            <div class="absolute right-0">
                <a class="font-medium text-white bg-green-500 px-6 py-2 rounded-lg"
                    href="/dashboard/pesanan-lainnya/create">Tambah</a>
            </div>
        </div>

        <div>
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">Nominal</th>
                        <th class="py-2 px-4 border-2 border-black">Sumber</th>
                        <th class="py-2 px-4 border-2 border-black">Tanggal</th>
                        <th class="py-2 px-4 border-2 border-black">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPendapatan = 0;
                    ?>

                    <?php if(isset($data) && count($data) !== 0): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totalPendapatan += $item->nominal;
                            ?>
                            <tr class="text-black text-center border-2 border-black">
                                <td class="w-[20%] border-2 border-black">
                                    Rp.<?php echo e(number_format($item->nominal_lainnya, 0, ',', '.')); ?>

                                </td>
                                <td class="border-2 border-black"><?php echo e($item->sumber_lainnya); ?></td>
                                <td class="border-2 border-black">
                                    <?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d/m/y')); ?>

                                </td>
                                <td class="w-[30%] border-2 border-black py-2">
                                    <div class="flex justify-center space-x-2">
                                        <a class="bg-yellow-500 px-4 py-1 rounded-md text-white"
                                            href="/dashboard/pesanan-lainnya/<?php echo e($item->id_pesanan_lainnya); ?>/edit">Edit</a>
                                        <form action="/dashboard/pesanan-lainnya/<?php echo e($item->id_pesanan_lainnya); ?>"
                                            method="post"
                                            onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <button class="bg-red-500 px-4 py-1 rounded-md text-white">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Pesanan Lainnya Kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="font-bold text-lg pt-4">Total Pesanan Lainnya:
                Rp.<?php echo e(isset($data) && count($data) !== 0 ? number_format($totalPendapatan, 0, ',', '.') : 0); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/pesananLuar/index.blade.php ENDPATH**/ ?>