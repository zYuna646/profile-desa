<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Preview Template Layanan">
                <x-slot name="header">
                    <div class="flex space-x-2">
                        <x-admin.button href="{{ route('admin.services.edit', $service) }}" variant="secondary">
                            Kembali
                        </x-admin.button>
                        <x-admin.button href="#" onclick="window.print()" variant="primary">
                            Cetak PDF
                        </x-admin.button>
                    </div>
                </x-slot>
                
                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Layanan</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Judul Layanan</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $service->title }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Template</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $service->template->name }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Data Template</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($service->template_data && count($service->template_data) > 0)
                                @foreach($service->template_data as $key => $value)
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ $key }}</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $value }}</p>
                                </div>
                                @endforeach
                            @else
                                <div class="col-span-2">
                                    <p class="text-sm text-gray-500 italic">Tidak ada data template yang diisi</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="print-section">
                        <h3 class="text-lg font-medium text-gray-900">Preview Dokumen</h3>
                        <div class="mt-4 p-6 border rounded-md bg-white">
                            <div class="prose max-w-none">
                                <!-- Ini akan diganti dengan konten dokumen yang sebenarnya -->
                                <h1 class="text-center">{{ $service->title }}</h1>
                                <p>Dokumen ini dibuat berdasarkan template: {{ $service->template->name }}</p>
                                
                                <div class="my-4">
                                    <p>Berikut adalah data yang digunakan:</p>
                                    <ul>
                                        @if($service->template_data && count($service->template_data) > 0)
                                            @foreach($service->template_data as $key => $value)
                                                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                            @endforeach
                                        @else
                                            <li>Tidak ada data yang diisi</li>
                                        @endif
                                    </ul>
                                </div>
                                
                                <p class="text-center mt-8">Ini adalah preview dokumen. Implementasi sebenarnya akan mengganti placeholder dalam template Word dengan data yang diisi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <style>
                    @media print {
                        body * {
                            visibility: hidden;
                        }
                        .print-section, .print-section * {
                            visibility: visible;
                        }
                        .print-section {
                            position: absolute;
                            left: 0;
                            top: 0;
                            width: 100%;
                        }
                    }
                </style>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>