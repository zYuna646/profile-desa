<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Stat Card 1 -->
                <x-admin.card class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-jordy-blue-400 bg-opacity-75 text-white mr-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-jordy-blue-600 truncate">Total Pengguna</div>
                    <div class="text-2xl font-semibold text-jordy-blue-900">{{ $stats['users'] }}</div>
                        </div>
                    </div>
                </x-admin.card>

                <!-- Stat Card 2 -->
                <x-admin.card class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-75 text-white mr-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-jordy-blue-600 truncate">Total Berita</div>
                    <div class="text-2xl font-semibold text-jordy-blue-900">{{ $stats['news'] }}</div>
                        </div>
                    </div>
                </x-admin.card>

                <!-- Stat Card 3 -->
                <x-admin.card class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75 text-white mr-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-jordy-blue-600 truncate">Total Layanan</div>
                    <div class="text-2xl font-semibold text-jordy-blue-900">{{ $stats['services'] }}</div>
                        </div>
                    </div>
                </x-admin.card>

                <!-- Stat Card 4 -->
                <x-admin.card class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-500 bg-opacity-75 text-white mr-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-jordy-blue-600 truncate">Pengunjung Hari Ini</div>
                    <div class="text-2xl font-semibold text-jordy-blue-900">{{ $stats['visitors_today'] }}</div>
                        </div>
                    </div>
                </x-admin.card>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activity -->
                <x-admin.card title="Aktivitas Terbaru" class="lg:col-span-2">
                    <div class="space-y-4">
                            @forelse($recentActivities as $activity)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center text-white">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Berita baru ditambahkan</p>
                                    <p class="text-sm text-gray-500">{{ $activity->description }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-sm text-gray-500 text-center py-4">
                                Tidak ada aktivitas terbaru
                            </div>
                            @endforelse
                        </div>
                    </div>
                </x-admin.card>

                <!-- Quick Actions -->
                <x-admin.card title="Aksi Cepat">
                        <div class="space-y-3">
                            <a href="{{ route('admin.news.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Tambah Berita Baru</p>
                                    <p class="text-xs text-gray-500">Buat dan publikasikan berita baru</p>
                                </div>
                            </a>

                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Tambah Layanan</p>
                                    <p class="text-xs text-gray-500">Tambahkan layanan desa baru</p>
                                </div>
                            </a>

                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Edit Profil Desa</p>
                                    <p class="text-xs text-gray-500">Perbarui informasi profil desa</p>
                                </div>
                            </a>

                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pengaturan Situs</p>
                                    <p class="text-xs text-gray-500">Kelola pengaturan website</p>
                                </div>
                            </a>
                        </div>
                </x-admin.card>
            </div>
        </div>
    </div>
</x-admin-layout>