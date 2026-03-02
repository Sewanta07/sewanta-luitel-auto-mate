<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to eSewa</title>
</head>
<body>
    <p>Redirecting to eSewa...</p>
    <form id="esewaPaymentForm" action="<?php echo e($endpoint); ?>" method="POST">
        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </form>

    <script>
        document.getElementById('esewaPaymentForm').submit();
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\payments\esewa-redirect.blade.php ENDPATH**/ ?>