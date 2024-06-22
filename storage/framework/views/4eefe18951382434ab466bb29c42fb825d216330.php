<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#D9BD8E">
    <meta name="msapplication-navbutton-color" content="#D9BD8E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#D9BD8E">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <?php echo $__env->yieldContent('title'); ?>
</head>

<body class="h-screen overflow-hidden">

    <div class="h-screen hidden md:block lg:max-w-[1000px] bg-white shadow-md mx-auto">

        <!-- Navigation -->
        <nav class="w-full h-20 flex items-center space-x-4 px-6 bg-blue-500 shadow-lg">
            <img class="w-12" src="/assets/logo.jpg" alt="Warung Siomay Ibu Cecep">
            <div class="font-medium text-2xl text-white">Warung Siomay Ibu Cecep</div>
        </nav>

        <!-- Content -->
        <div class="flex w-full h-full">
            <div class="flex flex-col justify-between w-[35%] shadow-xl pt-4 pb-24">
                <div class="space-y-5">
                    <div class="w-[75%] h-fit mx-auto <?php echo e(request()->is('dashboard') || request()->is('dashboard/filter*') || request()->is('dashboard/pesanan-baru*') || request()->is('dashboard/pesanan-belumbayar*') || request()->is('dashboard/pesanan-selesai*') ? 'bg-blue-500 text-white' : 'border-2 border-blue-500 text-blue-500'); ?> rounded-lg"
                        href="/dashboard">
                        <a class="flex justify-center text-sm text-center py-3 px-2" href="/dashboard">Dashboard</a>
                    </div>
                    <div class="w-[75%] h-fit mx-auto <?php echo e(request()->is('dashboard/pesanan*') && !request()->is('dashboard/pesanan-lainnya*') && !request()->is('dashboard/pesanan-baru*') && !request()->is('dashboard/pesanan-belumbayar*') && !request()->is('dashboard/pesanan-selesai*') ? 'bg-blue-500 text-white' : 'border-2 border-blue-500 text-blue-500'); ?> rounded-lg"
                        href="/dashboard">
                        <a class="flex justify-center text-sm text-center py-3 px-2" href="/dashboard/pesanan">Data
                            Pesanan</a>
                    </div>
                    <div class="w-[75%] h-fit mx-auto <?php echo e(request()->is('dashboard/menu*') ? 'bg-blue-500 text-white' : 'border-2 border-blue-500 text-blue-500'); ?> rounded-lg"
                        href="/dashboard">
                        <a class="flex justify-center text-sm text-center py-3 px-2" href="/dashboard/menu">Data
                            Menu</a>
                    </div>
                    <div class="w-[75%] h-fit mx-auto <?php echo e(request()->is('dashboard/pesanan-lainnya*') ? 'bg-blue-500 text-white' : 'border-2 border-blue-500 text-blue-500'); ?> rounded-lg"
                        href="/dashboard">
                        <a class="flex justify-center text-sm text-center py-3 px-2"
                            href="/dashboard/pesanan-lainnya">Pesanan Lainnya</a>
                    </div>
                    <div class="w-[75%] h-fit mx-auto <?php echo e(request()->is('dashboard/pengeluaran*') ? 'bg-blue-500 text-white' : 'border-2 border-blue-500 text-blue-500'); ?> rounded-lg"
                        href="/dashboard">
                        <a class="flex justify-center text-sm text-center py-3 px-2"
                            href="/dashboard/pengeluaran">Pengeluaran</a>
                    </div>
                    <div class="w-[75%] h-fit mx-auto <?php echo e(request()->is('dashboard/laporan-keuangan*') ? 'bg-blue-500 text-white' : 'border-2 border-blue-500 text-blue-500'); ?> rounded-lg"
                        href="/dashboard">
                        <a class="flex justify-center text-sm text-center py-3 px-2"
                            href="/dashboard/laporan-keuangan">Laporan Keuangan</a>
                    </div>
                    <div class="w-[75%] h-fit mx-auto <?php echo e(request()->is('dashboard/rating') ? 'bg-blue-500 text-white' : 'border-2 border-blue-500 text-blue-500'); ?> rounded-lg"
                        href="/dashboard">
                        <a class="flex justify-center text-sm text-center py-3 px-2" href="/dashboard/rating">Rating</a>
                    </div>
                </div>
                <form action="/logout" method="post">
                    <?php echo csrf_field(); ?>
                    <button
                        class="flex w-[75%] mx-auto bg-red-500 rounded-lg justify-center text-center text-sm text-white py-3 px-2">
                        Logout
                    </button>
                </form>
            </div>
            <div class="w-full pb-24 overflow-auto">
                <?php echo $__env->yieldContent('header'); ?>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <div
        class="h-screen w-full flex md:hidden lg:flex flex-col  space-y-4 justify-center items-center font-semibold text-xl">
        <svg class="w-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path
                d="M64 32C46.3 32 32 46.3 32 64V448c0 17.7 14.3 32 32 32H384c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32H64zM0 64C0 28.7 28.7 0 64 0H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zM192 400h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H192c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
        </svg>
        <div>Only Display for Tablet</div>
    </div>
</body>

</html>
<?php /**PATH E:\Project\sarah\e-menu\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>