@props(['title', 'subtitle'])

<div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden sm:rounded-lg border border-jordy-blue-200 transform hover:-translate-y-1">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-jordy-blue-800 mb-2">{{ $title }}</h1>
        <p class="text-jordy-blue-600">{{ $subtitle }}</p>
    </div>

    {{ $slot }}
</div>