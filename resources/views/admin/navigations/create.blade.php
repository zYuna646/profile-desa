<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Navigasi') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Tambah Navigasi">
                <form action="{{ route('admin.navigations.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-admin.label for="name" value="Nama Navigasi" />
                        <x-admin.input type="text" name="name" id="name" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-admin.input-error for="name" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="parent_id" value="Parent Menu (Opsional)" />
                        <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Tidak Ada (Menu Utama)</option>
                            @foreach(\App\Models\Navigation::whereNull('parent_id')->orderBy('order')->get() as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-admin.input-error for="parent_id" class="mt-2" />
                    </div>

                    <input type="hidden" name="type" id="type" value="route" />
                    <input type="hidden" name="route" id="route" value="landing.news.show" />
                    
                    <div>
                        <x-admin.label for="news_id" value="Pilih Berita (Opsional)" />
                        <select name="news_id" id="news_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Berita</option>
                            @foreach(\App\Models\News::where('is_active', true)->orderBy('title')->get() as $news)
                                <option value="{{ $news->id }}" {{ old('news_id') == $news->id ? 'selected' : '' }}>
                                    {{ $news->title }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Jika dipilih, navigasi ini akan mengarah ke halaman detail berita yang dipilih</p>
                        <x-admin.input-error for="news_id" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="icon" value="Icon (SVG atau Class)" />
                        <x-admin.input type="text" name="icon" id="icon" class="mt-1 block w-full" :value="old('icon')" />
                        <p class="text-sm text-gray-500 mt-1">Masukkan kode SVG atau nama class icon (contoh: fas fa-home)</p>
                        <x-admin.input-error for="icon" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.label for="order" value="Urutan" />
                        <x-admin.input type="number" name="order" id="order" class="mt-1 block w-full" :value="old('order', 0)" min="0" required />
                        <x-admin.input-error for="order" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <x-admin.checkbox id="active" name="active" :checked="old('active', true)" />
                        <x-admin.label for="active" value="Aktif" class="ml-2" />
                    </div>

                    <div class="flex justify-end space-x-2">
                        <x-admin.button href="{{ route('admin.navigations.index') }}" variant="secondary">
                            Kembali
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            Simpan
                        </x-admin.button>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>
</x-admin-layout>