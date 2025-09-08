@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-jordy-blue-700']) }}>
    {{ $value ?? $slot }}
</label>
