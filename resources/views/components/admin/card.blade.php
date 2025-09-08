@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'headerClass' => '',
    'bodyClass' => '',
    'footerClass' => '',
    'shadow' => 'shadow-md',
    'padding' => 'p-6'
])

<div {{ $attributes->merge(['class' => "bg-white rounded-lg border border-jordy-blue-200 {$shadow} hover:shadow-lg transition-shadow duration-200"]) }}>
    @if($title || $subtitle || $icon || isset($header))
        <div class="border-b border-jordy-blue-100 px-6 py-4 {{ $headerClass }}">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    @if($icon)
                        <div class="flex-shrink-0 text-jordy-blue-600">
                            {!! $icon !!}
                        </div>
                    @endif
                    <div>
                        @if($title)
                            <h3 class="text-lg font-semibold text-jordy-blue-900">{{ $title }}</h3>
                        @endif
                        @if($subtitle)
                            <p class="text-sm text-jordy-blue-600 mt-1">{{ $subtitle }}</p>
                        @endif
                    </div>
                </div>
                @isset($headerActions)
                    <div class="flex items-center space-x-2">
                        {{ $headerActions }}
                    </div>
                @endisset
            </div>
            @isset($header)
                <div class="mt-3">
                    {{ $header }}
                </div>
            @endisset
        </div>
    @endif

    <div class="{{ $padding }} {{ $bodyClass }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="border-t border-jordy-blue-100 px-6 py-4 bg-jordy-blue-50 rounded-b-lg {{ $footerClass }}">
            {{ $footer }}
        </div>
    @endisset
</div>