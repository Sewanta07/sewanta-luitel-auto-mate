@props(['title' => 'Title', 'count' => '0', 'accent' => 'teal', 'icon' => null, 'bgColor' => '#f0fdfa', 'textColor' => '#0d9488'])
<div class="cs-status-card p-4 rounded-2xl bg-white shadow-sm hover:shadow-md transition transform hover:-translate-y-0.5">
  <div class="cs-status-card-inner flex items-center">
    <div class="cs-status-card-icon-wrap cs-status-card-accent-{{ $accent }} w-12 h-12 rounded-lg flex items-center justify-center">
      {!! $icon ?? '' !!}
    </div>
    <div class="cs-status-card-body ml-4">
      <div class="cs-status-card-title text-sm text-gray-500">{{ $title }}</div>
      <div class="cs-status-card-count text-2xl font-semibold text-gray-900">{{ $count }}</div>
    </div>
  </div>
</div>
