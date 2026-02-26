@props([
    'title',
    'subtitle' => null,
    'chart' => 'monthly-revenue',
    'series' => [],
    'height' => 'h-72',
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md p-6']) }}>
    <div class="mb-4">
        <h2 class="text-lg font-bold text-gray-900">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-sm text-gray-500">{{ $subtitle }}</p>
        @endif
    </div>
    <div class="{{ $height }}" data-chart="{{ $chart }}" data-series='@json($series)'></div>
</div>
