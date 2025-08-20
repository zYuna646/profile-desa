@props(['title', 'description', 'icon'])

<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
    <div class="p-6">
        <div class="mb-5 inline-flex items-center justify-center w-16 h-16 rounded-full bg-madang-100 text-madang-600 group-hover:bg-madang-200 transition-colors duration-300">
            {!! $icon !!}
        </div>
        <h3 class="text-xl font-bold text-madang-900 mb-3 group-hover:text-madang-700 transition-colors">{{ $title }}</h3>
        <p class="text-madang-700">{{ $description }}</p>
    </div>
    <div class="h-1.5 w-full bg-gradient-to-r from-madang-300 to-madang-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
</div>
