<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Title', 'count' => '0', 'accent' => 'teal', 'icon' => null, 'bgColor' => '#f0fdfa', 'textColor' => '#0d9488']));

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

foreach (array_filter((['title' => 'Title', 'count' => '0', 'accent' => 'teal', 'icon' => null, 'bgColor' => '#f0fdfa', 'textColor' => '#0d9488']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="p-4 rounded-2xl bg-white shadow-sm hover:shadow-md transition transform hover:-translate-y-0.5">
  <div class="flex items-center">
    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: <?php echo e($bgColor); ?>; color: <?php echo e($textColor); ?>;">
      <?php echo $icon ?? ''; ?>

    </div>
    <div class="ml-4">
      <div class="text-sm text-gray-500"><?php echo e($title); ?></div>
      <div class="text-2xl font-semibold text-gray-900"><?php echo e($count); ?></div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\components\status-card.blade.php ENDPATH**/ ?>