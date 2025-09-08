<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($staff) ? 'Edit Staff' : 'Tambah Staff' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ isset($staff) ? route('admin.staff.update', $staff) : route('admin.staff.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          class="space-y-6">
                        @csrf
                        @if(isset($staff))
                            @method('PUT')
                        @endif

                        <div>
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                value="{{ old('name', $staff->name ?? '') }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="phone_number" value="Nomor Telepon" />
                            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" 
                                value="{{ old('phone_number', $staff->phone_number ?? '') }}" required />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="gender" value="Jenis Kelamin" />
                            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender', $staff->gender ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $staff->gender ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="position" value="Jabatan" />
                            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" 
                                value="{{ old('position', $staff->position ?? '') }}" required />
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="photo" value="Foto" />
                            <input type="file" id="photo" name="photo" class="mt-1 block w-full" accept="image/*">
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                            @if(isset($staff) && $staff->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $staff->photo) }}" alt="Current photo" class="h-20 w-20 object-cover rounded">
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                {{ old('is_active', $staff->is_active ?? true) ? 'checked' : '' }} 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <x-input-label for="is_active" value="Aktif" class="ml-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="submit">
                                {{ isset($staff) ? 'Update' : 'Simpan' }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>