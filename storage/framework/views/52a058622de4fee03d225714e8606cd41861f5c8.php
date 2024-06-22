

<?php $__env->startSection('title'); ?>
    <title>
        Dashboard - Pesanan</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="flex items-center shadow-lg pl-4 py-4 font-bold text-xl capitalize">Detail Pesanan</div>
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
        <div class="flex w-fit space-x-4">
            <div class="font-semibold">No Antri: <?php echo e($data->Antrian->nomor_antrian); ?></div>
            <div class="font-semibold"><?php echo e($data->jenis_pesanan); ?></div>
        </div>
        <div class="flex">
            <div class="w-full">
                <table class="w-full border-collapse border-2 border-black rounded-md">
                    <thead>
                        <tr class="text-center border-2 border-black">
                            <th class="p-2 border-2 border-black font-bold text-2xl" colspan="4">Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($data->status_pesanan == 'Belum Selesai' && $data->status_pembayaran == 'Belum Dibayar'): ?>
                            <tr class="border-2 border-b-0 border-black">
                                <td colspan="4">
                                    <div class="flex px-2 pt-2"> <a class="bg-green-400 px-4 py-1 rounded-md text-white"
                                            href="<?php echo e(url('/dashboard/pesanan/tambah/' . $data->id_pesanan)); ?>">Tambah</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $data->Details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-2 border-black border-t-0">
                                <td class="w-[40%]">
                                    <div class="p-2 ">
                                        <div class="font-bold text-lg">
                                            <?php echo e($item->Menu->nama_menu); ?>

                                        </div>
                                        <?php $__currentLoopData = json_decode($item->add_on); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addOnValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="font-medium text-sm">
                                                <?php echo e($addOnValue); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="pt-2">Catatan:</div>
                                        <div class="pt-2"><?php echo e($item->catatan); ?></div>
                                    </div>
                                </td>
                                <td class="font-bold text-right"><?php echo e($item->jumlah_menu); ?></td>
                                <td class="font-bold text-right px-2">
                                    Rp.<?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></td>
                                <?php if($data->status_pesanan == 'Belum Selesai' && $data->status_pembayaran == 'Belum Dibayar'): ?>
                                    <td class="">
                                        <div class="flex flex-col justify-center items-end space-y-2 px-2">
                                            <a class="w-24 bg-gray-300 py-1 rounded-md text-white"
                                                href="<?php echo e(url('/dashboard/pesanan/edit/' . $item->id_pesanan_detail)); ?>">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <svg class="w-3 fill-white" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                    </svg>
                                                    <div>Edit</div>
                                                </div>
                                            </a>
                                            <form action="/dashboard/pesanan/hapus/<?php echo e($item->id_pesanan_detail); ?>"
                                                method="POST"
                                                onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                <button class="w-24 bg-red-500/80 py-1 rounded-md text-white"
                                                    href="<?php echo e(url('/dashboard/pesanan/edit/' . $item->id_pesanan_detail)); ?>">
                                                    <div class="flex justify-center items-center space-x-2">
                                                        <svg class="w-3 fill-white" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512">
                                                            <path
                                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                        </svg>
                                                        <div>Hapus</div>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="p-2 border-2 border-black" colspan="4">
                                <div class="flex justify-between font-bold text-lg">
                                    <div>Total Harga</div>
                                    <div>Rp.<?php echo e(number_format($data->total_harga, 0, ',', '.')); ?></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <?php if($data->status_pesanan == 'Belum Selesai' || $data->status_pembayaran == 'Belum Dibayar'): ?>
                <div class="w-[25%] flex justify-center items-center border-2 border-l-0 border-black">
                    <?php if($data->status_pesanan == 'Belum Selesai'): ?>
                        <a href="<?php echo e(url('/dashboard/pesanan/selesai/' . $data->id_pesanan)); ?>">
                            <div class="bg-green-500 px-4 py-2 font-medium text-white rounded-md">
                                Selesai
                            </div>
                        </a>
                    <?php elseif($data->status_pesanan == 'Selesai' && $data->status_pembayaran == 'Belum Dibayar'): ?>
                        <a href="<?php echo e(url('/dashboard/pesanan/bayar/' . $data->id_pesanan)); ?>">
                            <div class="bg-green-500 p-2 rounded-md">
                                <svg class="w-8 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                </svg>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
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

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\sarah\e-menu\resources\views/dashboard/pesanan/detail.blade.php ENDPATH**/ ?>