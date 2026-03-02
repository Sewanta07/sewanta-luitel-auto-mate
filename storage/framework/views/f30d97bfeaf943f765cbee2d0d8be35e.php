<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'AutoMate'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/customer-core.css', 'resources/js/app.js', 'resources/js/customer-core.js']); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="app-layout-body">
    <div class="app-layout-root">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\layouts\customer-core.blade.php ENDPATH**/ ?>