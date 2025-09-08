@props(['loading' => false])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-jordy-blue-400 to-jordy-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-jordy-blue-500 hover:to-jordy-blue-600 focus:from-jordy-blue-500 focus:to-jordy-blue-600 active:from-jordy-blue-600 active:to-jordy-blue-700 focus:outline-none focus:ring-2 focus:ring-jordy-blue-400 focus:ring-offset-2 transition-all ease-in-out duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed']) }}
    x-bind:disabled="loading">
    <div class="relative inline-flex items-center">
        <span class="relative z-10 flex items-center">
            <div x-show="loading" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>{{ __('Processing...') }}</span>
            </div>
            <span x-show="!loading">{{ $slot }}</span>
        </span>
        <div class="absolute inset-0 bg-gradient-to-r from-white to-transparent opacity-0 group-hover:opacity-20 rounded transition-opacity duration-300"></div>
    </div>
</button>