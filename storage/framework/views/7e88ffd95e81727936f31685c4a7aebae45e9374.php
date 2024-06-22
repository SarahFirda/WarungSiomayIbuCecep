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
    <title>Login</title>
</head>

<body>
    <div class="w-full h-screen max-w-[800px] bg-white shadow-md mx-auto">
        <div class="flex h-screen justify-center items-center">
            <div class="w-[70%] bg-black/10 py-12 rounded-xl">
                <form action="/login" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="text-center font-medium text-2xl pb-6">Login Admin</div>
                    <?php if(session()->has('loginError')): ?>
                        <div class="flex justify-center pb-4">
                            <div class="w-fit bg-red-500/80 rounded-md px-4 py-2 text-white"><?php echo e(session('loginError')); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="flex flex-col w-full items-center space-y-4">
                        <div class="w-[70%] flex items-center bg-white px-5 py-3 space-x-3 rounded-xl shadow-md">
                            <input class="w-full text-lg bg-transparent focus:outline-none" type="text"
                                name="username" id="username" value="<?php echo e(old('username')); ?>" placeholder="Username"
                                autocomplete="off" required>
                        </div>
                        <div class="w-[70%] flex items-center bg-white px-5 py-3 space-x-3 rounded-xl shadow-md">
                            <input class="w-full text-lg bg-transparent focus:outline-none" type="password"
                                name="password" id="password" placeholder="Password" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="pt-12 space-y-4">
                        <div class="flex w-full justify-center">
                            <button type="submit"
                                class="font-medium text-white text-xl px-[75px] py-[12px] bg-blue-600 rounded-xl shadow-md">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH E:\Project\sarah\e-menu\resources\views/auth/index.blade.php ENDPATH**/ ?>