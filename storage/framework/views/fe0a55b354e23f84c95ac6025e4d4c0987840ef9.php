

<?php $__env->startSection('title'); ?>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Dashboard</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <?php if(session('success')): ?>
            <div id="alert"
                class="flex justify-between items-center bg-green-500/80 rounded-md font-semibold text-white capitalize px-4 py-2 my-2">
                <div>
                    <?php echo e(session('success')); ?>

                </div>
                <svg id="closeAlert" class="w-3 fill-white cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512">
                    <path
                        d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                </svg>
            </div>
        <?php endif; ?>

        <div class="flex justify-between items-center">
            <div>
                <div class="font-base text-base capitalize">Selamat Datang,</div>
                <div class="font-medium text-base capitalize"><?php echo e(Auth::user()->username); ?> Warung Ibu Cecep</div>
            </div>
            <a href="<?php echo e(url('/resetAntrian')); ?>">
                <div class="px-4 py-2 bg-red-500 rounded-md font-semibold text-white">Reset Antrian</div>
            </a>
        </div>
        <div class="grid grid-cols-3 gap-3 pt-4">
            <div class="w-full flex flex-col justify-between pt-8 px-2 rounded-md shadow-lg">
                <div class="flex flex-col items-center space-y-3">
                    <div class="flex items-center space-x-4">
                        <svg class="h-12 fill-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                        </svg>
                        <div class="font-semibold text-4xl leading-none"><?php echo e(count($pesananBaru)); ?></div>
                    </div>
                    <div class="text-lg text-gray-400 leading-none pb-4">Pesanan Baru</div>
                </div>

                <a href="/dashboard/pesanan-baru" class="w-full border-t-2 py-2 px-4 border-gray-300 flex justify-between">
                    <div class="font-semibold">Lihat Detail</div>
                    <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                    </svg>
                </a>
            </div>

            <div class="w-full flex flex-col justify-between pt-8 px-2 rounded-md shadow-lg">
                <div class="flex flex-col items-center space-y-3">
                    <div class="flex items-center space-x-4">
                        <svg class="h-12 fill-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M112 112c0 35.3-28.7 64-64 64V336c35.3 0 64 28.7 64 64H464c0-35.3 28.7-64 64-64V176c-35.3 0-64-28.7-64-64H112zM0 128C0 92.7 28.7 64 64 64H512c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zm288 32a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                        </svg>
                        <div class="font-semibold text-4xl leading-none"><?php echo e(count($pesananBelumBayar)); ?></div>
                    </div>
                    <div class="text-lg text-gray-400 text-center leading-none pb-4">Pesanan Belum Bayar</div>
                </div>

                <a href="/dashboard/pesanan-belumbayar"
                    class="w-full border-t-2 py-2 px-4 border-gray-300 flex justify-between">
                    <div class="font-semibold">Lihat Detail
                    </div>
                    <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                    </svg>
                </a>
            </div>

            <div class="w-full flex flex-col justify-between pt-8 px-2 rounded-md shadow-lg">
                <div class="flex flex-col items-center space-y-3">
                    <div class="flex items-center space-x-4">
                        <svg class="h-12 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z" />
                        </svg>
                    </div>
                    <div class="text-lg text-gray-400 text-center leading-none pb-4">Pesanan Selesai</div>
                </div>

                <a href="/dashboard/pesanan-selesai"
                    class="w-full border-t-2 py-2 px-4 border-gray-300 flex justify-between">
                    <div class="font-semibold">Lihat Detail
                    </div>
                    <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="pt-4 space-y-4">
            <div class="font-semibold text-lg">Grafik Data Penjualan</div>
            <form action="<?php echo e('/dashboard/filter'); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-fit bg-white px-2 py-1 space-x-3 rounded-lg outline outline-1 shadow-md">
                            <input class="w-full text-sm bg-transparent focus:outline-none" type="date"
                                name="tanggalAwal" value="<?php echo e($tanggalAwal); ?>" id="tanggalAwal" autocomplete="off" required>
                        </div>
                        <div class="font-bold">-</div>
                        <div class="w-fit bg-white px-2 py-1 space-x-3 rounded-lg outline outline-1 shadow-md">
                            <input class="w-full text-sm bg-transparent focus:outline-none" type="date"
                                name="tanggalAkhir" value="<?php echo e($tanggalAkhir); ?>" id="tanggalAkhir" autocomplete="off"
                                required>
                        </div>
                        <div class="w-fit bg-white px-2 py-1 space-x-3 rounded-lg outline outline-1 shadow-md">
                            <select class="w-full text-sm bg-transparent focus:outline-none" name="periode" id="periode">
                                <?php $__currentLoopData = $periodeData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item); ?>"<?php if($item == $periode): ?> selected <?php endif; ?>>
                                        <?php echo e($item); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="px-6 py-2 text-sm rounded-md text-white bg-blue-500">Filter Grafik</button
                        type="submit">
                </div>
            </form>
            <div class="w-full mx-auto">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var pesananChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: <?php echo json_encode($datasets); ?>,
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            var alert = document.getElementById('alert');

            function hideAlert() {
                alert.style.display = 'none';
            }
            document.getElementById('closeAlert').addEventListener('click', hideAlert);
            setTimeout(hideAlert, 3000);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-menu\resources\views/dashboard/index.blade.php ENDPATH**/ ?>