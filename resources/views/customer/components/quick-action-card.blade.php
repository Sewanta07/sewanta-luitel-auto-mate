@props(['title' => 'Action', 'subtitle' => '', 'accent' => 'teal', 'bgColor' => '#f0fdfa', 'textColor' => '#0d9488'])
<div class="p-6 rounded-2xl bg-white shadow-sm hover:shadow-md hover:-translate-y-1 transition cursor-default">
  <div class="flex items-start">
    <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4" style="background-color: {{ $bgColor }}; color: {{ $textColor }};">
      {{ $slot }}
    </div>
    <div>
      <div class="text-lg font-semibold text-gray-900">{{ $title }}</div>
      @if($subtitle)
        <div class="text-sm text-gray-500 mt-1">{{ $subtitle }}</div>
      @endif
    </div>
  </div>
</div>
