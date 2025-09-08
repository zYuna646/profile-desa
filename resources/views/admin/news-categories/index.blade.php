<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Kategori Berita</h2>
                <x-admin.button href="{{ route('admin.news-categories.create') }}" variant="primary">
                    Tambah Kategori
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Berita</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                        @if ($category->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($category->description, 50) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->slug }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-admin.badge :variant="$category->is_active ? 'success' : 'danger'">
                                            {{ $category->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </x-admin.badge>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->news_count ?? $category->news()->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <x-admin.button href="{{ route('admin.news-categories.edit', $category) }}" variant="secondary" size="sm">
                                            Edit
                                        </x-admin.button>
                                        <form action="{{ route('admin.news-categories.destroy', $category) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                Hapus
                                            </x-admin.button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                        Tidak ada kategori berita.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>