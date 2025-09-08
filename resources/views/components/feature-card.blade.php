@props(['title', 'description', 'icon'])

<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
    <div class="p-6">
        <div class="mb-5 inline-flex items-center justify-center w-16 h-16 rounded-full bg-jordy-blue-100 text-jordy-blue-600 group-hover:bg-jordy-blue-200 transition-colors duration-300">
            {!! $icon !!}
        </div>
        <h3 class="text-xl font-bold text-jordy-blue-900 mb-3 group-hover:text-jordy-blue-700 transition-colors">{{ $title }}</h3>
        <p class="text-jordy-blue-700">{{ $description }}</p>
    </div>
    <div class="h-1.5 w-full bg-gradient-to-r from-jordy-blue-300 to-jordy-blue-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
</div>
