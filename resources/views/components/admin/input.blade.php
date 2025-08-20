@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'value' => '',
    'error' => null,
    'help' => null,
    'icon' => null,
    'iconPosition' => 'left', // left, right
    'size' => 'md', // sm, md, lg
    'rows' => 3
])

@php
    $inputId = $name ?? 'input_' . uniqid();
    
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-3 text-base'
    ];
    
    $baseInputClasses = 'block w-full rounded-lg border-madang-300 shadow-sm transition-colors duration-200 focus:border-madang-500 focus:ring-madang-500 disabled:bg-gray-50 disabled:text-gray-500';
    $inputClasses = $baseInputClasses . ' ' . $sizeClasses[$size];
    
    if ($error) {
        $inputClasses .= ' border-red-300 focus:border-red-500 focus:ring-red-500';
    }
    
    if ($icon) {
        $inputClasses .= $iconPosition === 'left' ? ' pl-10' : ' pr-10';
    }
@endphp

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-madang-900">
            {{ $label }}
            @if($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 {{ $iconPosition === 'left' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center pointer-events-none text-madang-400">
                {!! $icon !!}
            </div>
        @endif
        
        @if($type === 'textarea')
            <textarea
                id="{{ $inputId }}"
                name="{{ $name }}"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
                @if($readonly) readonly @endif
                class="{{ $inputClasses }}"
            >{{ old($name, $value) }}</textarea>
        @elseif($type === 'select')
            <select
                id="{{ $inputId }}"
                name="{{ $name }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
                class="{{ $inputClasses }}"
            >
                {{ $slot }}
            </select>
        @else
            <input
                type="{{ $type }}"
                id="{{ $inputId }}"
                name="{{ $name }}"
                value="{{ old($name, $value) }}"
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
                @if($readonly) readonly @endif
                class="{{ $inputClasses }}"
            />
        @endif
    </div>
    
    @if($error)
        <p class="text-sm text-red-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            {{ $error }}
        </p>
    @elseif($help)
        <p class="text-sm text-madang-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            {{ $help }}
        </p>
    @endif
</div>