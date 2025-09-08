@props([
    'variant' => 'primary', // primary, secondary, success, danger, warning, info
    'size' => 'md', // sm, md, lg
    'rounded' => 'rounded-full' // rounded-full, rounded-md, rounded-lg
])

@php
    $baseClasses = 'inline-flex items-center font-medium';
    
    $sizeClasses = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-1 text-sm',
        'lg' => 'px-3 py-1.5 text-base'
    ];
    
    $variantClasses = [
        'primary' => 'bg-jordy-blue-100 text-jordy-blue-800 border border-jordy-blue-200',
        'secondary' => 'bg-gray-100 text-gray-800 border border-gray-200',
        'success' => 'bg-green-100 text-green-800 border border-green-200',
        'danger' => 'bg-red-100 text-red-800 border border-red-200',
        'warning' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
        'info' => 'bg-blue-100 text-blue-800 border border-blue-200',
        'dark' => 'bg-gray-800 text-white',
        'light' => 'bg-white text-gray-800 border border-gray-300'
    ];
    
    $classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $variantClasses[$variant] . ' ' . $rounded;
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>