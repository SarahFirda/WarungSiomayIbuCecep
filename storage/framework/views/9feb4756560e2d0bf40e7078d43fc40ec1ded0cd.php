
<?php echo \Livewire\Livewire::styles(); ?>


<?php $__env->startSection('title'); ?>
    <title>Dashboard - <?php if($model->exists): ?>
            Edit
        <?php else: ?>
            Tambah
        <?php endif; ?> Menu Pesanan
    </title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="top-0 sticky flex items-center bg-white shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Menu Pesanan
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="flex justify-center">
            <div class="font-bold text-2xl">
                <?php if($model->exists): ?>
                    Edit
                <?php else: ?>
                    Tambah
                <?php endif; ?> Menu Pesanan
            </div>
        </div>
        <form class="space-y-4"
            action="<?php echo e($model->exists ? '/dashboard/pesanan/edit/' . $model->id_pesanan_detail : '/dashboard/pesanan/tambah'); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field($model->exists ? 'PUT' : 'POST'); ?>
            <input hidden name="id_pesanan" id="id_pesanan" value="<?php echo e($model->exists ? $model->id_pesanan : $id_pesanan); ?>">

            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('select-option', ['pesananData' => $model])->html();
} elseif ($_instance->childHasBeenRendered('THPVL5U')) {
    $componentId = $_instance->getRenderedChildComponentId('THPVL5U');
    $componentTag = $_instance->getRenderedChildComponentTagName('THPVL5U');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('THPVL5U');
} else {
    $response = \Livewire\Livewire::mount('select-option', ['pesananData' => $model]);
    $html = $response->html();
    $_instance->logRenderedChild('THPVL5U', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

            <div class="space-y-2">
                <label class="font-semibold" for="nama">Jumlah Menu</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <input class="w-full bg-transparent focus:outline-none" type="number" name="jumlah_menu"
                        id="jumlah_menu" value="<?php echo e(old('jumlah_menu', $model->jumlah_menu)); ?>"
                        placeholder="Isikan Jumlah Menu Makanan" autocomplete="off" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="font-semibold" for="nama">Catatan</label>
                <div class="w-full bg-white px-4 py-2 space-x-3 rounded-lg outline outline-1 shadow-md">
                    <textarea class="w-full bg-transparent focus:outline-none" name="catatan" id="catatan"
                        placeholder="Isikan Catatan Makanan (Optional)" autocomplete="off" rows="5"><?php echo e(old('catatan', $model->deskripsi_menu)); ?></textarea>
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

<?php echo \Livewire\Livewire::scripts(); ?>


<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/pesanan/formMenu.blade.php ENDPATH**/ ?>