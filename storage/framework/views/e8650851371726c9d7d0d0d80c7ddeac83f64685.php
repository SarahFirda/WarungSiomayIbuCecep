

<?php $__env->startSection('title'); ?>
    <title>Dashboard - <?php if($model->exists): ?>
            Edit
        <?php else: ?>
            Tambah
        <?php endif; ?> Pengeluaran
    </title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Pengeluaran</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="flex justify-center">
            <div class="font-bold text-2xl">
                <?php if($model->exists): ?>
                    Edit
                <?php else: ?>
                    Tambah
                <?php endif; ?> Pengeluaran
            </div>
        </div>
        <form class="space-y-4"
            action="<?php echo e($model->exists ? '/dashboard/pengeluaran/' . $model->id_pengeluaran : '/dashboard/pengeluaran'); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field($model->exists ? 'PUT' : 'POST'); ?>
            <div class="space-y-2">
                <label class="font-semibold" for="nominal">Nominal</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="number" name="nominal_pengeluaran"
                        id="nominal_pengeluaran" value="<?php echo e(old('nominal_pengeluaran', $model->nominal_pengeluaran)); ?>"
                        placeholder="Isikan Nominal" autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="keperluan">Keperluan</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="text" name="keperluan_pengeluaran"
                        id="keperluan_pengeluaran" value="<?php echo e(old('keperluan_pengeluaran', $model->keperluan_pengeluaran)); ?>"
                        placeholder="Isikan Keperluan Pembelanjaan" autocomplete="off" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-semibold" for="tanggal">Tanggal</label>
                <div class="w-fit bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="date" name="tanggal_pengeluaran"
                        id="tanggal_pengeluaran" value="<?php echo e(old('tanggal_pengeluaran', $model->tanggal_pengeluaran)); ?>"
                        autocomplete="off" required>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 font-medium text-white px-6 py-2 rounded-lg">
                    <?php if($model->exists): ?>
                        Selesai
                    <?php else: ?>
                        Tambah
                    <?php endif; ?>
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/pengeluaran/form.blade.php ENDPATH**/ ?>