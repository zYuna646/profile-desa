<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Tipe Infografis</h2>
                <x-admin.button href="{{ route('admin.infographic-types.create') }}" variant="primary">
                    Tambah Tipe Infografis
                </x-admin.button>
            </div>

            <x-admin.card>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Infografis</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($types as $type)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $type->name }}</div>
                                        @if ($type->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($type->description, 50) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $type->slug }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-admin.badge :variant="$type->is_active ? 'success' : 'danger'">
                                            {{ $type->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </x-admin.badge>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $type->order }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $type->infographics_count ?? $type->infographics()->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <x-admin.button href="{{ route('admin.infographic-types.edit', $type) }}" variant="secondary" size="sm">
                                            Edit
                                        </x-admin.button>
                                        <form action="{{ route('admin.infographic-types.destroy', $type) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tipe infografis ini?')">
                                                Hapus
                                            </x-admin.button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                        Tidak ada tipe infografis.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $types->links() }}
                </div>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>