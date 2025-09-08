@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-jordy-blue-500 focus:ring-jordy-blue-500 rounded-md shadow-sm']) !!}>