

<?php $__env->startSection('title'); ?>
    <title>Dashboard - Data Menu</title>
    <?php echo \Livewire\Livewire::styles(); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Data Menu</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="p-4">
        <div class="relative flex justify-center items-center pb-4">
            <div class="font-bold uppercase text-2xl">menu</div>
            <div class="absolute right-0">
                <a class="font-medium text-white bg-green-500 px-6 py-2 rounded-lg" href="/dashboard/menu/create">Tambah</a>
            </div>
        </div>

        <div>
            <table class="w-full rounded-xl">
                <tr class="text-black text-center border-2 border-black">
                    <th class="py-2 border-2 border-black">Gambar</th>
                    <th class="py-2 border-2 border-black">Nama</th>
                    <th class="py-2 border-2 border-black">Harga</th>
                    <th class="py-2 border-2 border-black">Action</th>
                </tr>
                <?php if(count($data) !== 0): ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="text-black text-center border-2 border-black">
                            <td class="w-[20%] border-2 border-black">
                                <img class="w-full p-4" src="<?php echo e(asset('storage/' . $item->gambar)); ?>" alt="">
                            </td>
                            <td class="border-2 border-black"><?php echo e($item->nama); ?></td>
                            <td class="border-2 border-black">Rp.<?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                            <td class="w-[30%] border-2 border-black py-2">
                                <div class="space-y-4 space-x-2">
                                    <div class="flex justify-center space-x-2">
                                        <a class="bg-yellow-500 px-4 py-1 rounded-md text-white"
                                            href="/dashboard/menu/<?php echo e($item->id_produk); ?>/edit">Edit</a>
                                        <form action="/dashboard/menu/<?php echo e($item->id_produk); ?>" method="post"
                                            onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <button class="bg-red-500 px-4 py-1 rounded-md text-white">Hapus</button>
                                        </form>
                                    </div>
                                    <div>
                                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('toggle-switch', ['model' => $item,'field' => 'stok'])->html();
} elseif ($_instance->childHasBeenRendered(''.e($item->id_produk).'')) {
    $componentId = $_instance->getRenderedChildComponentId(''.e($item->id_produk).'');
    $componentTag = $_instance->getRenderedChildComponentTagName(''.e($item->id_produk).'');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild(''.e($item->id_produk).'');
} else {
    $response = \Livewire\Livewire::mount('toggle-switch', ['model' => $item,'field' => 'stok']);
    $html = $response->html();
    $_instance->logRenderedChild(''.e($item->id_produk).'', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr class="text-black text-center border-2 border-black">
                        <td class="w-full border-2 border-black py-12" colspan="4">Data Menu Kosong</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/produk/index.blade.php ENDPATH**/ ?>