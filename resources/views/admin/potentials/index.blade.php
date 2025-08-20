<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Potensi Desa">
                <x-slot name="header">
                    <x-admin.button href="{{ route('admin.potentials.create') }}" variant="primary">
                        Tambah Potensi
                    </x-admin.button>
                </x-slot>
                
                @if(session('success'))
                    <x-admin.alert type="success" class="mb-4">
                        {{ session('success') }}
                    </x-admin.alert>
                @endif

                <x-admin.table :headers="['No', 'Gambar', 'Judul', 'Deskripsi', 'Urutan', 'Status', 'Aksi']" striped hoverable>
                                @forelse($potentials as $index => $potential)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($potential->image)
                                                <img src="{{ asset('storage/' . $potential->image) }}" alt="{{ $potential->title }}" class="h-10 w-10 rounded-full object-cover">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <i class="{{ $potential->icon ?? 'fas fa-chart-line' }} text-gray-500"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $potential->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ Str::limit($potential->description, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $potential->order }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-admin.badge variant="{{ $potential->is_active ? 'success' : 'danger' }}">
                                                {{ $potential->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </x-admin.badge>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <x-admin.button href="{{ route('admin.potentials.edit', $potential) }}" variant="outline" size="sm" class="inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </x-admin.button>
                                                <form action="{{ route('admin.potentials.destroy', $potential) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus potensi ini?')">
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
                                            Tidak ada potensi desa. Silakan tambahkan potensi baru.
                                        </td>
                                    </tr>
                                @endforelse
                </x-admin.table>
                
                <div class="mt-4">
                    {{ $potentials->links() }}
                </div>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>