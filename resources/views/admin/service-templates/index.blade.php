<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Template Layanan">
                <x-slot name="header">
                    <x-admin.button href="{{ route('admin.service-templates.create') }}" variant="primary">
                        Tambah Template
                    </x-admin.button>
                </x-slot>
                
                @if(session('success'))
                    <x-admin.alert type="success" class="mb-4">
                        {{ session('success') }}
                    </x-admin.alert>
                @endif

                @if(session('error'))
                    <x-admin.alert type="danger" class="mb-4">
                        {{ session('error') }}
                    </x-admin.alert>
                @endif

                <x-admin.table :headers="['No', 'Nama', 'Deskripsi', 'Status', 'Variabel', 'Aksi']" striped hoverable>
                    @forelse($templates as $index => $template)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $template->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ Str::limit($template->description, 50) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-admin.badge variant="{{ $template->is_active ? 'success' : 'danger' }}">
                                    {{ $template->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </x-admin.badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <button type="button" class="text-jordy-blue-600 hover:text-jordy-blue-900 underline" 
                                        onclick="showVariables({{ $template->id }}, '{{ $template->name }}')">
                                    Lihat Variabel
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <x-admin.button href="{{ route('admin.service-templates.download', $template) }}" variant="outline" size="sm" class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download
                                    </x-admin.button>
                                    <x-admin.button href="{{ route('admin.service-templates.edit', $template) }}" variant="outline" size="sm" class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </x-admin.button>
                                    <form action="{{ route('admin.service-templates.destroy', $template) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus template ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-admin.button type="submit" variant="danger" size="sm" class="inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </x-admin.button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada template layanan yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </x-admin.table>
                
                <div class="mt-4">
                    {{ $templates->links() }}
                </div>
            </x-admin.card>
        </div>
    </div>
    
    <!-- Modal Variabel -->
    <div id="variablesModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Variabel Template</h3>
                    <button type="button" onclick="closeVariablesModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-6 py-4">
                <p class="text-sm text-gray-600 mb-4">Gunakan variabel berikut dalam template dokumen Word dengan format <strong>@{{NAMA_VARIABEL}}</strong>:</p>
                <div id="variablesList" class="space-y-2">
                    <!-- Variabel akan ditampilkan di sini -->
                </div>
            </div>
            <div class="px-6 py-3 bg-gray-50 text-right rounded-b-lg">
                <button type="button" onclick="closeVariablesModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    
    <script>
        function showVariables(templateId, templateName) {
            const variablesList = document.getElementById('variablesList');
            variablesList.innerHTML = '<div class="text-center py-4"><svg class="animate-spin h-5 w-5 mx-auto text-jordy-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="mt-2 text-sm text-gray-600">Memuat variabel...</p></div>';
            
            document.getElementById('variablesModal').classList.remove('hidden');
            
            // Fetch variables from API
            fetch(`/admin/service-templates/${templateId}/variables`)
                .then(response => response.json())
                .then(data => {
                    variablesList.innerHTML = '';
                    
                    if (data.error) {
                        variablesList.innerHTML = `<div class="text-center py-4"><p class="text-red-500">${data.error}</p></div>`;
                        return;
                    }
                    
                    if (data.variables && data.variables.length > 0) {
                        data.variables.forEach(variable => {
                            const description = data.descriptions[variable] || 'Variabel untuk template';
                            const item = document.createElement('div');
                            item.className = 'flex items-start';
                            item.innerHTML = `
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="h-4 w-4 text-jordy-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm font-medium text-gray-900">@{{${variable}}}</p>
                                    <p class="text-sm text-gray-500">${description}</p>
                                </div>
                            `;
                            variablesList.appendChild(item);
                        });
                    } else {
                        variablesList.innerHTML = '<div class="text-center py-4"><p class="text-gray-500">Tidak ada variabel yang ditemukan dalam template.</p></div>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching variables:', error);
                    variablesList.innerHTML = '<div class="text-center py-4"><p class="text-red-500">Gagal memuat variabel. Silakan coba lagi.</p></div>';
                });
        }
        
        function closeVariablesModal() {
            document.getElementById('variablesModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>