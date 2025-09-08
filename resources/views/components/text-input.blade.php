@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-jordy-blue-200 focus:border-jordy-blue-400 focus:ring-jordy-blue-400 rounded-md shadow-sm transition-all duration-300']) }}>
