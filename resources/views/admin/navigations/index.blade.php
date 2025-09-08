<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Navigasi') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Daftar Navigasi">
                <x-slot name="header">
                    <x-admin.button href="{{ route('admin.navigations.create') }}" variant="primary">
                        Tambah Navigasi
                    </x-admin.button>
                </x-slot>
                
                @if (session('success'))
                    <x-admin.alert type="success" class="mb-4">
                        {{ session('success') }}
                    </x-admin.alert>
                @endif

                <x-admin.table :headers="['No', 'Nama', 'Tipe', 'Destinasi', 'Urutan', 'Status', 'Aksi']" striped hoverable>
                    @forelse ($navigations as $index => $navigation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                @if ($navigation->parent_id)
                                    <span class="ml-4">└ {{ $navigation->name }} <span class="text-gray-500 text-xs">(Parent: {{ $navigation->parent->name ?? 'Tidak ada' }})</span></span>
                                @else
                                    <strong>{{ $navigation->name }}</strong>
                                    @if ($navigation->children->count() > 0)
                                        <span class="text-gray-500 text-xs">({{ $navigation->children->count() }} submenu)</span>
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $navigation->type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($navigation->type == 'route')
                                    @if ($navigation->news_id)
                                        {{ $navigation->route }} ({{ \App\Models\News::find($navigation->news_id)->title ?? 'Berita tidak ditemukan' }})
                                    @else
                                        {{ $navigation->route }} (Tanpa berita)
                                    @endif
                                @elseif ($navigation->type == 'url')
                                    <a href="{{ $navigation->url }}" target="_blank" class="text-blue-500 hover:underline">
                                        {{ $navigation->url }}
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $navigation->order }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-admin.badge variant="{{ $navigation->active ? 'success' : 'danger' }}">
                                    {{ $navigation->active ? 'Aktif' : 'Tidak Aktif' }}
                                </x-admin.badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <x-admin.button href="{{ route('admin.navigations.edit', $navigation->id) }}" variant="outline" size="sm" class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </x-admin.button>
                                    <form action="{{ route('admin.navigations.destroy', $navigation->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus navigasi ini?')">
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
                                Tidak ada navigasi. Silakan tambahkan navigasi baru.
                            </td>
                        </tr>
                    @endforelse
                </x-admin.table>
                
                <div class="mt-4">
                    {{ $navigations->links() }}
                </div>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>