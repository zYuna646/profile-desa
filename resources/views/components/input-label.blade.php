@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-madang-700']) }}>
    {{ $value ?? $slot }}
</label>
