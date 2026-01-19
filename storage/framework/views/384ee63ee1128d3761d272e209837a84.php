<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => 'home',
    'size' => 'w-6 h-6',
    'class' => 'text-gray-600',
    'solid' => false
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
    'icon' => 'home',
    'size' => 'w-6 h-6',
    'class' => 'text-gray-600',
    'solid' => false
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<svg 
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        $size,
        $class
    ]); ?>"
    xmlns="http://www.w3.org/2000/svg" 
    viewBox="0 0 24 24" 
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round" 
    stroke-linejoin="round"
    <?php echo e($attributes); ?>

>
    <?php switch($icon):
        
        case ('home'): ?>
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
            <?php break; ?>

        
        <?php case ('calendar'): ?>
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
            <?php break; ?>

        
        <?php case ('settings'): ?>
            <circle cx="12" cy="12" r="3"></circle>
            <path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m5.08 5.08l4.24 4.24M1 12h6m6 0h6M4.22 19.78l4.24-4.24m5.08-5.08l4.24-4.24"></path>
            <?php break; ?>

        
        <?php case ('check-circle'): ?>
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
            <?php break; ?>

        
        <?php case ('wrench'): ?>
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 1 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
            <?php break; ?>

        
        <?php case ('tool'): ?>
            <path d="M12.3 12.1A6.3 6.3 0 0 0 2 8a6 6 0 0 0 9.6 5.4"></path>
            <path d="M9.3 8.1a3 3 0 1 0 5.4 3"></path>
            <?php break; ?>

        
        <?php case ('car'): ?>
            <circle cx="4.5" cy="16.5" r="2.5"></circle>
            <circle cx="19.5" cy="16.5" r="2.5"></circle>
            <rect x="2" y="6" width="20" height="10" rx="2"></rect>
            <path d="M6 6V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"></path>
            <?php break; ?>

        
        <?php case ('clock'): ?>
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
            <?php break; ?>

        
        <?php case ('info'): ?>
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
            <?php break; ?>

        
        <?php case ('users'): ?>
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            <?php break; ?>

        
        <?php case ('plus'): ?>
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <?php break; ?>

        
        <?php case ('edit'): ?>
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            <?php break; ?>

        
        <?php case ('delete'): ?>
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            <line x1="10" y1="11" x2="10" y2="17"></line>
            <line x1="14" y1="11" x2="14" y2="17"></line>
            <?php break; ?>

        
        <?php case ('search'): ?>
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            <?php break; ?>

        
        <?php case ('lock'): ?>
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            <?php break; ?>

        
        <?php case ('mail'): ?>
            <rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect>
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            <?php break; ?>

        
        <?php case ('arrow-right'): ?>
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
            <?php break; ?>

        
        <?php case ('menu'): ?>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
            <?php break; ?>

        
        <?php case ('x'): ?>
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
            <?php break; ?>

        <?php default: ?>
            
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
            <line x1="12" y1="22.08" x2="12" y2="12"></line>
    <?php endswitch; ?>
</svg>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/components/icon.blade.php ENDPATH**/ ?>