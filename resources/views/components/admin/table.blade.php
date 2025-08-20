@props([
    'headers' => [],
    'striped' => true,
    'hoverable' => true,
    'bordered' => true,
    'responsive' => true
])

@php
    $tableClasses = 'min-w-full divide-y divide-madang-200';
    $containerClasses = 'bg-white shadow-md rounded-lg overflow-hidden border border-madang-200';
    
    if ($responsive) {
        $containerClasses .= ' overflow-x-auto';
    }
@endphp

<div {{ $attributes->merge(['class' => $containerClasses]) }}>
    <table class="{{ $tableClasses }}">
        @if(!empty($headers))
            <thead class="bg-madang-50">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-madang-700 uppercase tracking-wider">
                            @if(is_array($header))
                                {{ $header['label'] ?? '' }}
                                @if(isset($header['sortable']) && $header['sortable'])
                                    <svg class="w-4 h-4 inline ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 12l5 5 5-5H5z"/>
                                    </svg>
                                @endif
                            @else
                                {{ $header }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
        @endif
        
        @isset($header)
            <thead class="bg-madang-50">
                {{ $header }}
            </thead>
        @endisset
        
        <tbody class="bg-white divide-y divide-madang-200">
            {{ $slot }}
        </tbody>
        
        @isset($footer)
            <tfoot class="bg-madang-25">
                {{ $footer }}
            </tfoot>
        @endisset
    </table>
</div>

@push('styles')
<style>
    .admin-table tbody tr:nth-child(even) {
        @if($striped)
            background-color: #f8fdf9; /* madang-25 */
        @endif
    }
    
    .admin-table tbody tr {
        @if($hoverable)
            transition: background-color 0.2s ease;
        @endif
    }
    
    .admin-table tbody tr:hover {
        @if($hoverable)
            background-color: #eefff0; /* madang-50 */
        @endif
    }
</style>
@endpush