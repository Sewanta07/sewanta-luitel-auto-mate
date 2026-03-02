<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'subtitle' => null,
    'chart' => 'monthly-revenue',
    'series' => [],
    'height' => '18rem',
]));

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

foreach (array_filter(([
    'title',
    'subtitle' => null,
    'chart' => 'monthly-revenue',
    'series' => [],
    'height' => '18rem',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'ad-panel'])); ?>>
    <div class="ad-panel-head">
        <h2 class="ad-panel-title"><?php echo e($title); ?></h2>
        <?php if($subtitle): ?>
            <p class="ad-subtitle"><?php echo e($subtitle); ?></p>
        <?php endif; ?>
    </div>
    <div style="height: <?php echo e($height); ?>;" data-chart="<?php echo e($chart); ?>" data-series='<?php echo json_encode($series, 15, 512) ?>'></div>
</div>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\components\admin\chart-card.blade.php ENDPATH**/ ?>