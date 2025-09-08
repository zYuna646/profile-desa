<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Navigasi') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Detail Navigasi</h2>
                <div class="flex space-x-2">
                    <x-admin.button href="{{ route('admin.navigations.edit', $navigation->id) }}" variant="primary">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </x-admin.button>
                    <x-admin.button href="{{ route('admin.navigations.index') }}" variant="secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </x-admin.button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-admin.card title="Informasi Navigasi">
                    <div class="space-y-4">
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">Nama</div>
                            <div class="col-span-2 text-sm text-gray-900">{{ $navigation->name }}</div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">Tipe</div>
                            <div class="col-span-2 text-sm text-gray-900">{{ $navigation->parent_id ? 'Sub Menu' : 'Menu Utama' }}</div>
                        </div>
                        
                        @if($navigation->parent_id)
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">Parent Menu</div>
                            <div class="col-span-2 text-sm text-gray-900">{{ $navigation->parent->name ?? 'Tidak ditemukan' }}</div>
                        </div>
                        @endif
                        
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">Route</div>
                            <div class="col-span-2 text-sm text-gray-900">{{ $navigation->route ?? '-' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">URL</div>
                            <div class="col-span-2 text-sm text-gray-900">{{ $navigation->url ?? '-' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">Icon</div>
                            <div class="col-span-2 text-sm text-gray-900">
                                @if ($navigation->icon)
                                    <div class="flex items-center">
                                        <div class="mr-2">{!! $navigation->icon !!}</div>
                                        <code class="text-xs bg-gray-100 p-1 rounded">{{ htmlspecialchars($navigation->icon) }}</code>
                                    </div>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">Urutan</div>
                            <div class="col-span-2 text-sm text-gray-900">{{ $navigation->order }}</div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-medium text-gray-500">Status</div>
                            <div class="col-span-2">
                                <x-admin.badge variant="{{ $navigation->active ? 'success' : 'danger' }}">
                                    {{ $navigation->active ? 'Aktif' : 'Tidak Aktif' }}
                                </x-admin.badge>
                            </div>
                        </div>
                    </div>
                </x-admin.card>

                @if ($navigation->children->count() > 0)
                <x-admin.card title="Sub Menu">
                    <x-admin.table :headers="['Nama', 'Urutan', 'Status', 'Aksi']" striped hoverable>
                        @foreach ($navigation->children as $child)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $child->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $child->order }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-admin.badge variant="{{ $child->active ? 'success' : 'danger' }}">
                                    {{ $child->active ? 'Aktif' : 'Tidak Aktif' }}
                                </x-admin.badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <x-admin.button href="{{ route('admin.navigations.edit', $child->id) }}" variant="outline" size="sm">
                                        <i class="fas fa-edit"></i>
                                    </x-admin.button>
                                    <x-admin.button href="{{ route('admin.navigations.show', $child->id) }}" variant="outline" size="sm">
                                        <i class="fas fa-eye"></i>
                                    </x-admin.button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </x-admin.table>
                </x-admin.card>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>