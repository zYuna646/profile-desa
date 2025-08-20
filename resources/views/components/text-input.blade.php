@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-madang-200 focus:border-madang-500 focus:ring-madang-500 rounded-md shadow-sm transition-all duration-300']) }}>
