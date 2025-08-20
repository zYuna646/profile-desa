@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-madang-600 bg-madang-50 p-3 rounded-md border border-madang-200']) }}>
        {{ $status }}
    </div>
@endif
