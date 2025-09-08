<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-jordy-blue-400 to-jordy-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-jordy-blue-500 hover:to-jordy-blue-600 focus:from-jordy-blue-500 focus:to-jordy-blue-600 active:from-jordy-blue-600 active:to-jordy-blue-700 focus:outline-none focus:ring-2 focus:ring-jordy-blue-400 focus:ring-offset-2 transition-all ease-in-out duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5']) }}>
    <div class="relative inline-flex items-center">
        <span class="relative z-10">{{ $slot }}</span>
        <div class="absolute inset-0 bg-gradient-to-r from-white to-transparent opacity-0 group-hover:opacity-20 rounded transition-opacity duration-300"></div>
    </div>
</button>
