<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Staff Dashboard'); ?> - AutoMate</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    
    <?php if (isset($component)) { $__componentOriginal17611e3b8decae96c78f7c1ff2705ab1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal17611e3b8decae96c78f7c1ff2705ab1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.staff-navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('staff-navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal17611e3b8decae96c78f7c1ff2705ab1)): ?>
<?php $attributes = $__attributesOriginal17611e3b8decae96c78f7c1ff2705ab1; ?>
<?php unset($__attributesOriginal17611e3b8decae96c78f7c1ff2705ab1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal17611e3b8decae96c78f7c1ff2705ab1)): ?>
<?php $component = $__componentOriginal17611e3b8decae96c78f7c1ff2705ab1; ?>
<?php unset($__componentOriginal17611e3b8decae96c78f7c1ff2705ab1); ?>
<?php endif; ?>

    
    <main class="min-h-screen">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="bg-white border-t border-gray-200 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                © <?php echo e(date('Y')); ?> AutoMate. All rights reserved.
            </p>
        </div>
    </footer>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\layouts\staff.blade.php ENDPATH**/ ?>