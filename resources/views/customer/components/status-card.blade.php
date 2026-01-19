@props(['title' => 'Title', 'count' => '0', 'accent' => 'teal', 'icon' => null, 'bgColor' => '#f0fdfa', 'textColor' => '#0d9488'])
<div class="p-4 rounded-2xl bg-white shadow-sm hover:shadow-md transition transform hover:-translate-y-0.5">
  <div class="flex items-center">
    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: {{ $bgColor }}; color: {{ $textColor }};">
      {!! $icon ?? '' !!}
    </div>
    <div class="ml-4">
      <div class="text-sm text-gray-500">{{ $title }}</div>
      <div class="text-2xl font-semibold text-gray-900">{{ $count }}</div>
    </div>
  </div>
</div>
