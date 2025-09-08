<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Detail Template Layanan">
                <x-slot name="header">
                    <div class="flex space-x-2">
                        <x-admin.button href="{{ route('admin.service-templates.index') }}" variant="secondary">
                            Kembali
                        </x-admin.button>
                        <x-admin.button href="{{ route('admin.service-templates.edit', $template) }}" variant="primary">
                            Edit Template
                        </x-admin.button>
                    </div>
                </x-slot>
                
                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Template</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Template</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $template->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="mt-1">
                                    <x-admin.badge variant="{{ $template->is_active ? 'success' : 'danger' }}">
                                        {{ $template->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </x-admin.badge>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">File Template</h3>
                        <div class="mt-4">
                            @if($template->file_path)
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-600">{{ basename($template->file_path) }}</p>
                                        <a href="{{ route('admin.service-templates.download', $template) }}" class="text-sm text-jordy-blue-600 hover:text-jordy-blue-900 flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download Template
                                        </a>
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic">Tidak ada file template</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Deskripsi</h3>
                        <div class="mt-4 prose max-w-none">
                            @if($template->description)
                                <p class="text-sm text-gray-600">{{ $template->description }}</p>
                            @else
                                <p class="text-sm text-gray-500 italic">Tidak ada deskripsi</p>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Variabel Template</h3>
                        <div class="mt-4">
                            @if(isset($template->variables) && count($template->variables) > 0)
                                <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Variabel</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($template->variables as $mark => $description)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">@{{{{ $mark }}}}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $description }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic">Tidak ada variabel yang ditentukan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>