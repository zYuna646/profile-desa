@props(['icon', 'type' => 'text', 'disabled' => false])

<div class="relative">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-jordy-blue-400">
        <i class="{{ $icon }} w-5 h-5"></i>
    </div>
    
    <input 
        type="{{ $type }}" 
        @disabled($disabled) 
        {{ $attributes->merge([
            'class' => 'pl-10 w-full border-jordy-blue-200 focus:border-jordy-blue-400 focus:ring-jordy-blue-400 rounded-md shadow-sm transition-all duration-300 placeholder:text-jordy-blue-300'
        ]) }}
    >
</div>