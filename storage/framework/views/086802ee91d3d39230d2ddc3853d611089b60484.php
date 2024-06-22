

<?php $__env->startSection('title'); ?>
    <title>Dashboard - Laporan Keuangan</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Laporan Keuangan</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-4">
        <div class="relative flex justify-center items-center px-4">
            <div class="font-bold text-2xl">Laporan Keuangan</div>
            <div class="absolute right-4 font-medium text-white bg-red-500 px-6 py-2 rounded-lg">
                <a class="flex space-x-2" href="#">
                    <svg class="w-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z" />
                    </svg>
                    <div>Cetak PDF</div>
                </a>
            </div>
        </div>
        <form action="<?php echo e('/dashboard/laporan-keuangan/filter'); ?>" method="POST">
            <div class="flex justify-between items-center mb-12 p-4 shadow-md">
                <?php echo csrf_field(); ?>
                <div class="flex space-x-6">
                    <div class="w-fit bg-white px-2 py-1 space-x-3 rounded-lg outline outline-1 shadow-md">
                        <input class="w-full bg-transparent focus:outline-none" type="date" name="start_date"
                            id="start_date" autocomplete="off" required>
                    </div>
                    <div class="w-fit bg-white px-2 py-1 space-x-3 rounded-lg outline outline-1 shadow-md">
                        <input class="w-full bg-transparent focus:outline-none" type="date" name="end_date"
                            id="end_date" autocomplete="off" required>
                    </div>
                </div>
                <button type="submit" class="px-6 py-2 rounded-md text-white bg-blue-500">Filter Tanggal</button
                    type="submit">
            </div>
        </form>

        <div class="font-bold text-xl text-center pb-4">Data Pendapatan</div>
        <div class="px-4">
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">No Antri</th>
                        <th class="py-2 px-4 border-2 border-black">Total</th>
                        <th class="py-2 px-4 border-2 border-black">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPendapatan = 0;
                    ?>

                    <?php if(isset($pendapatan) && count($pendapatan) !== 0): ?>
                        <?php $__currentLoopData = $pendapatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totalPendapatan += $item->grand_total;
                            ?>
                            <tr class="text-black text-center border-2 border-black">
                                <td class="border-2 border-black"><?php echo e($item->Antrian->nomor_antrian); ?></td>
                                <td class="border-2 border-black">Rp.<?php echo e(number_format($item->grand_total, 0, ',', '.')); ?>

                                </td>
                                <td class="border-2 border-black">
                                    <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d/m/y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Pendapatan Kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="font-bold text-lg pt-4 pb-8">Total Pendapatan:
                Rp.<?php echo e(isset($pendapatan) && count($pendapatan) !== 0 ? number_format($totalPendapatan, 0, ',', '.') : 0); ?>

            </div>
        </div>

        <div class="font-bold text-xl text-center pb-4">Data Pesanan Luar</div>
        <div class="px-4">
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">Nominal</th>
                        <th class="py-2 px-4 border-2 border-black">Sumber</th>
                        <th class="py-2 px-4 border-2 border-black">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPesananLuar = 0;
                    ?>

                    <?php if(isset($pesananLuar) && count($pesananLuar) !== 0): ?>
                        <?php $__currentLoopData = $pesananLuar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totalPesananLuar += $item->nominal;
                            ?>
                            <tr class="text-black text-center border-2 border-black">
                                <td class="border-2 border-black">Rp.<?php echo e(number_format($item->nominal, 0, ',', '.')); ?></td>
                                <td class="border-2 border-black"><?php echo e($item->sumber); ?></td>
                                <td class="border-2 border-black">
                                    <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d/m/y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Pesanan Luar Kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="font-bold text-lg pt-4 pb-8">Total Pesanan Luar:
                Rp.<?php echo e(isset($pesananLuar) && count($pesananLuar) !== 0 ? number_format($totalPesananLuar, 0, ',', '.') : 0); ?>

            </div>
        </div>

        <div class="font-bold text-xl text-center pb-4">Data Pembelanjaan</div>
        <div class="px-4">
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">Nominal</th>
                        <th class="py-2 px-4 border-2 border-black">Keperluan</th>
                        <th class="py-2 px-4 border-2 border-black">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPembelanjaan = 0;
                    ?>

                    <?php if(isset($pembelanjaan) && count($pembelanjaan) !== 0): ?>
                        <?php $__currentLoopData = $pembelanjaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totalPembelanjaan += $item->nominal;
                            ?>
                            <tr class="text-black text-center border-2 border-black">
                                <td class="border-2 border-black">Rp.<?php echo e(number_format($item->nominal, 0, ',', '.')); ?></td>
                                <td class="border-2 border-black"><?php echo e($item->keperluan); ?></td>
                                <td class="border-2 border-black">
                                    <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d/m/y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Pembelanjaan Kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="font-bold text-lg pt-4">Total Pembelanjaan:
                Rp.<?php echo e(isset($pembelanjaan) && count($pembelanjaan) !== 0 ? number_format($totalPembelanjaan, 0, ',', '.') : 0); ?>

            </div>
            <?php
                $grandTotal = $totalPendapatan + $totalPesananLuar + $totalPembelanjaan;
            ?>

            <div class="font-bold text-lg pt-4">Grand Total:
                Rp.<?php echo e(number_format($grandTotal, 0, ',', '.') ?? 0); ?>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/laporan/filter.blade.php ENDPATH**/ ?>