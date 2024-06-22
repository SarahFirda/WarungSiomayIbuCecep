

<?php $__env->startSection('title'); ?>
    <title>Dashboard - Pesanan</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pesanan</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="relative flex justify-center items-center pb-4">
            <div class="font-bold text-2xl">Pesanan</div>
            <div class="absolute right-0">
                
            </div>
        </div>

        <div>
            <table class="w-full rounded-xl">
                <thead>
                    <tr class="text-black text-center border-2 border-black">
                        <th class="py-2 px-4 border-2 border-black">Status</th>
                        <th class="py-2 px-4 border-2 border-black">No Antri</th>
                        <th class="py-2 px-4 border-2 border-black">Dibuat</th>
                        <th class="py-2 px-4 border-2 border-black">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data) && count($data) !== 0): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-black text-center border-2 border-black">
                                <td class="border-2 border-black">
                                    <?php echo e($item->status_pembayaran); ?>

                                </td>
                                <td class="w-[20%] border-2 border-black"><?php echo e($item->Antrian->nomor_antrian); ?></td>
                                <td class="w-[30%] border-2 border-black py-2">
                                    <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d/m/y')); ?>

                                </td>
                                <td class="w-[30%] border-2 border-black py-2">
                                    <div class="flex justify-center space-x-2">
                                        <a class="bg-gray-300 px-4 py-1 rounded-md text-white"
                                            href="<?php echo e(url('/dashboard/pesanan/' . $item->id_pesanan)); ?>">Detail</a>
                                        <form action="/dashboard/pesanan/<?php echo e($item->id_pesanan); ?>" method="post"
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
                            <td class="w-full border-2 border-black py-12" colspan="4">Data Pesanan Kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-menu\resources\views/dashboard/pesanan/index.blade.php ENDPATH**/ ?>