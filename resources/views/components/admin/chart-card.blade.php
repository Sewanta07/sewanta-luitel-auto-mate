@props([
    'title',
    'subtitle' => null,
    'chart' => 'monthly-revenue',
    'series' => [],
    'height' => '18rem',
])

<div {{ $attributes->merge(['class' => 'ad-panel']) }}>
    <div class="ad-panel-head">
        <h2 class="ad-panel-title">{{ $title }}</h2>
        @if($subtitle)
            <p class="ad-subtitle">{{ $subtitle }}</p>
        @endif
    </div>
    <div style="height: {{ $height }};" data-chart="{{ $chart }}" data-series='@json($series)'></div>
</div>
