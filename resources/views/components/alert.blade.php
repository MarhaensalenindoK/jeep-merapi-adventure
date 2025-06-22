@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false,
    'icon' => true
])

@php
$types = [
    'success' => [
        'container' => 'bg-green-50 border-green-200 text-green-800',
        'icon' => 'check',
        'iconColor' => 'text-green-500',
        'titleColor' => 'text-green-800',
        'textColor' => 'text-green-700',
        'buttonColor' => 'text-green-500 hover:text-green-600',
    ],
    'error' => [
        'container' => 'bg-red-50 border-red-200 text-red-800',
        'icon' => 'close',
        'iconColor' => 'text-red-500',
        'titleColor' => 'text-red-800',
        'textColor' => 'text-red-700',
        'buttonColor' => 'text-red-500 hover:text-red-600',
    ],
    'warning' => [
        'container' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
        'icon' => 'warning',
        'iconColor' => 'text-yellow-500',
        'titleColor' => 'text-yellow-800',
        'textColor' => 'text-yellow-700',
        'buttonColor' => 'text-yellow-500 hover:text-yellow-600',
    ],
    'info' => [
        'container' => 'bg-blue-50 border-blue-200 text-blue-800',
        'icon' => 'info',
        'iconColor' => 'text-blue-500',
        'titleColor' => 'text-blue-800',
        'textColor' => 'text-blue-700',
        'buttonColor' => 'text-blue-500 hover:text-blue-600',
    ],
];

$config = $types[$type] ?? $types['info'];
$alertId = 'alert-' . Str::random(8);
@endphp

<div {{ $attributes->merge(['class' => 'px-4 py-3 border rounded-lg ' . $config['container']]) }}
     @if($dismissible) x-data="{ show: true }" x-show="show" id="{{ $alertId }}" @endif>

    <div class="flex items-start">
        @if($icon)
            <div class="flex-shrink-0">
                <x-icon :type="$config['icon']" class="w-5 h-5 {{ $config['iconColor'] }}" />
            </div>
        @endif

        <div class="{{ $icon ? 'ml-3' : '' }} flex-1">
            @if($title)
                <h3 class="text-sm font-medium {{ $config['titleColor'] }}">{{ $title }}</h3>
                <div class="mt-1 text-sm {{ $config['textColor'] }}">
                    {{ $slot }}
                </div>
            @else
                <div class="text-sm {{ $config['textColor'] }}">
                    {{ $slot }}
                </div>
            @endif
        </div>

        @if($dismissible)
            <div class="ml-auto pl-3">
                <button @click="show = false"
                        class="inline-flex {{ $config['buttonColor'] }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="sr-only">Tutup</span>
                    <x-icon type="close" class="w-4 h-4" />
                </button>
            </div>
        @endif
    </div>
</div>
