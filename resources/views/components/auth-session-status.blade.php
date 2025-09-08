@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-jordy-blue-600 bg-jordy-blue-50 p-3 rounded-md border border-jordy-blue-200']) }}>
        {{ $status }}
    </div>
@endif
