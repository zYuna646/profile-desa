<x-landing-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('landing.infographics.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ml-2">Infografis</a>
                        </div>
                    </li>
                    @if($infographic->infographicType)
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('landing.infographics.byType', $infographic->infographicType->slug) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ml-2">{{ $infographic->infographicType->name }}</a>
                        </div>
                    </li>
                    @endif
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $infographic->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Infographic Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $infographic->title }}</h1>
                @if($infographic->description)
                    <p class="text-lg text-gray-600">{{ $infographic->description }}</p>
                @endif
            </div>

            <!-- Infographic Image -->
            @if($infographic->image)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $infographic->image) }}" alt="{{ $infographic->title }}" class="w-full rounded-lg shadow-md">
                </div>
            @endif

            <!-- Infographic Data Visualization -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Infografis</h2>
                </div>

                @if(empty($infographic->data))
                    <p class="text-gray-500">Tidak ada data yang tersedia untuk infografis ini.</p>
                @else
                    @if($infographic->diagram_type == 'table')
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left">Label</th>
                                        <th class="py-2 px-4 border-b text-right">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($infographic->data as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-2 px-4 border-b">{{ $item['label'] ?? 'Tidak ada label' }}</td>
                                            <td class="py-2 px-4 border-b text-right font-semibold">{{ $item['value'] ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif($infographic->diagram_type == 'bar' || $infographic->diagram_type == 'pie' || $infographic->diagram_type == 'line')
                        <div class="mb-4">
                            <canvas id="chart-container" style="height: 400px;"></canvas>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const chartContainer = document.getElementById('chart-container');
                                
                                if (chartContainer) {
                                    const ctx = chartContainer.getContext('2d');
                                    const data = @json($infographic->data);
                                    const labels = data.map(item => item.label);
                                    const values = data.map(item => item.value);
                                    
                                    const chartType = '{{ $infographic->diagram_type }}';
                                    const chartConfig = {
                                        type: chartType,
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: '{{ $infographic->title }}',
                                                data: values,
                                                backgroundColor: [
                                                    'rgba(54, 162, 235, 0.5)',
                                                    'rgba(255, 99, 132, 0.5)',
                                                    'rgba(255, 206, 86, 0.5)',
                                                    'rgba(75, 192, 192, 0.5)',
                                                    'rgba(153, 102, 255, 0.5)',
                                                    'rgba(255, 159, 64, 0.5)',
                                                    'rgba(199, 199, 199, 0.5)',
                                                    'rgba(83, 102, 255, 0.5)',
                                                    'rgba(40, 159, 64, 0.5)',
                                                    'rgba(210, 199, 199, 0.5)'
                                                ],
                                                borderColor: [
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)',
                                                    'rgba(199, 199, 199, 1)',
                                                    'rgba(83, 102, 255, 1)',
                                                    'rgba(40, 159, 64, 1)',
                                                    'rgba(210, 199, 199, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    display: chartType !== 'pie'
                                                }
                                            }
                                        }
                                    };
                                    
                                    new Chart(ctx, chartConfig);
                                }
                            });
                        </script>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($infographic->data as $item)
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-primary-600 mb-2">{{ $item['value'] ?? '-' }}</div>
                                    <div class="text-sm text-gray-600">{{ $item['label'] ?? 'Tidak ada label' }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>

            <!-- Back Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('landing.infographics.index') }}" class="inline-flex items-center text-gray-700 hover:text-primary-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Infografis
                </a>

                @if($infographic->infographicType)
                    <a href="{{ route('landing.infographics.byType', $infographic->infographicType->slug) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700">
                        Lihat Semua {{ $infographic->infographicType->name }}
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-landing-layout>