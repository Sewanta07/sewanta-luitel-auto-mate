<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Action', 'subtitle' => '', 'accent' => 'teal', 'bgColor' => '#f0fdfa', 'textColor' => '#0d9488']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title' => 'Action', 'subtitle' => '', 'accent' => 'teal', 'bgColor' => '#f0fdfa', 'textColor' => '#0d9488']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="p-6 rounded-2xl bg-white shadow-sm hover:shadow-md hover:-translate-y-1 transition cursor-default">
  <div class="flex items-start">
    <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4" style="background-color: <?php echo e($bgColor); ?>; color: <?php echo e($textColor); ?>;">
      <?php echo e($slot); ?>

    </div>
    <div>
      <div class="text-lg font-semibold text-gray-900"><?php echo e($title); ?></div>
      <?php if($subtitle): ?>
        <div class="text-sm text-gray-500 mt-1"><?php echo e($subtitle); ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\components\quick-action-card.blade.php ENDPATH**/ ?>