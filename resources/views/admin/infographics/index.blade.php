<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Infografis">
                <x-slot name="header">
                    <x-admin.button href="{{ route('admin.infographics.create') }}" variant="primary">
                        Tambah Infografis
                    </x-admin.button>
                </x-slot>
                
                @if(session('success'))
                    <x-admin.alert type="success" class="mb-4">
                        {{ session('success') }}
                    </x-admin.alert>
                @endif

                <x-admin.table :headers="['No', 'Gambar', 'Judul', 'Tipe', 'Diagram', 'Status', 'Urutan', 'Aksi']" striped hoverable>
                    @forelse($infographics as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-10 w-10 rounded-lg object-cover">
                                @else
                                    <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                        @if($item->diagram_type == 'bar')
                                            <i class="fas fa-chart-bar text-gray-500"></i>
                                        @elseif($item->diagram_type == 'pie')
                                            <i class="fas fa-chart-pie text-gray-500"></i>
                                        @elseif($item->diagram_type == 'line')
                                            <i class="fas fa-chart-line text-gray-500"></i>
                                        @elseif($item->diagram_type == 'table')
                                            <i class="fas fa-table text-gray-500"></i>
                                        @else
                                            <i class="fas fa-chart-pie text-gray-500"></i>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->infographicType->name ?? 'Tidak ada tipe' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($item->diagram_type)
                                    <span class="inline-flex items-center">
                                        @if($item->diagram_type == 'bar')
                                            <i class="fas fa-chart-bar mr-1"></i>
                                        @elseif($item->diagram_type == 'pie')
                                            <i class="fas fa-chart-pie mr-1"></i>
                                        @elseif($item->diagram_type == 'line')
                                            <i class="fas fa-chart-line mr-1"></i>
                                        @elseif($item->diagram_type == 'table')
                                            <i class="fas fa-table mr-1"></i>
                                        @endif
                                        {{ ucfirst($item->diagram_type) }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-admin.badge variant="{{ $item->is_active ? 'success' : 'danger' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </x-admin.badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <x-admin.button href="{{ route('admin.infographics.edit', $item) }}" variant="outline" size="sm" class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </x-admin.button>
                                    <form action="{{ route('admin.infographics.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus infografis ini?')">
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
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Tidak ada infografis. Silakan tambahkan infografis baru.
                            </td>
                        </tr>
                    @endforelse
                </x-admin.table>
                
                <div class="mt-4">
                    {{ $infographics->links() }}
                </div>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>