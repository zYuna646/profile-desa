<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-madang-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-madang-600 focus:bg-madang-600 active:bg-madang-700 focus:outline-none focus:ring-2 focus:ring-madang-500 focus:ring-offset-2 transition ease-in-out duration-300 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>
