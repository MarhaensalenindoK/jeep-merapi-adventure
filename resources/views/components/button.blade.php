@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'iconOnly' => false,
    'href' => null,
    'type' => 'button'
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variants = [
    'primary' => 'bg-admin-primary text-white hover:bg-admin-secondary focus:ring-admin-primary',
    'secondary' => 'bg-admin-secondary text-white hover:bg-admin-primary focus:ring-admin-secondary',
    'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
    'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500',
    'gray' => 'bg-gray-500 text-white hover:bg-gray-600 focus:ring-gray-500',
    'outline' => 'border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:ring-admin-primary',
    'ghost' => 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:ring-admin-primary',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-2.5 text-base',
    'icon-sm' => 'p-1.5',
    'icon-md' => 'p-2',
    'icon-lg' => 'p-3',
];

$iconSizes = [
    'sm' => 'w-3 h-3',
    'md' => 'w-4 h-4',
    'lg' => 'w-5 h-5',
];

// Responsive behavior untuk mobile
$responsiveClasses = $iconOnly ? 'sm:px-4 sm:py-2' : '';

$classes = implode(' ', array_filter([
    $baseClasses,
    $variants[$variant] ?? $variants['primary'],
    $iconOnly ? ($sizes['icon-' . $size] ?? $sizes['icon-md']) : ($sizes[$size] ?? $sizes['md']),
    $responsiveClasses,
    $attributes->get('class'),
]));

$iconClass = $iconSizes[$size] ?? $iconSizes['md'];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->except('class')->merge(['class' => $classes]) }}>
        @if($icon)
            <x-icon :type="$icon" :class="$slot->isEmpty() ? $iconClass : $iconClass . ' ' . ($iconOnly ? 'sm:mr-2' : 'mr-2')" />
        @endif

        @if(!$slot->isEmpty())
            <span class="{{ $iconOnly ? 'hidden sm:inline' : '' }}">{{ $slot }}</span>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->except('class')->merge(['class' => $classes]) }}>
        @if($icon)
            <x-icon :type="$icon" :class="$slot->isEmpty() ? $iconClass : $iconClass . ' ' . ($iconOnly ? 'sm:mr-2' : 'mr-2')" />
        @endif

        @if(!$slot->isEmpty())
            <span class="{{ $iconOnly ? 'hidden sm:inline' : '' }}">{{ $slot }}</span>
        @endif
    </button>
@endif
