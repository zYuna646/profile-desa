@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <p class="text-sm text-red-600 transform motion-safe:transition-all motion-safe:duration-300 motion-safe:animate-shake">
                {{ $message }}
            </p>
        @endforeach
    </div>
@endif
