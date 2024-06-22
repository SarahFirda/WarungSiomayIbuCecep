<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-navbutton-color" content="#D9BD8E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#D9BD8E">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>HomePage</title>
</head>

<body>
    <div class="w-full h-dvh bg-gray-100 md:max-w-[480px] shadow-md mx-auto">
        <div class="flex h-full justify-center items-center">
            <div class="w-[75%] rounded-xl space-y-1 bg-white shadow-md">
                <div class="font-semibold text-xl text-center leading-none pt-6">Selamat Datang di</div>
                <div class="font-semibold text-xl text-center leading-none">Warung Siomay Ibu Cecep</div>
                <div class="font-medium text-sm text-center leading-none pt-3">Silahkan pilih opsi dibawah ini</div>
                <div class="flex items-end py-6 space-x-2 px-6">
                    <div class="font-medium text-lg leading-none">No Antri: </div>
                    <div class="font-bold text-2xl leading-none"><?php echo e($nomor_antrian); ?></div>
                </div>
                <div class="flex justify-between items-center p-6">
                    <a href="<?php echo e(url('/antrian/makandisini')); ?>">
                        <div
                            class="flex items-center justify-center h-10 w-24 border-2 border-[#ae0001] font-medium text-[#ae0001] text-center text-sm rounded-md">
                            Makan
                            Disini
                        </div>
                    </a>
                    <div class="font-medium">atau</div>
                    <a href="<?php echo e(url('/antrian/dibungkus')); ?>">
                        <div
                            class="flex items-center justify-center h-10 w-24 bg-[#ae0001] font-medium text-white text-center text-sm rounded-md">
                            Dibungkus
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\e-menu\resources\views/antrian.blade.php ENDPATH**/ ?>