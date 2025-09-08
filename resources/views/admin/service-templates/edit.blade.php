<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.card title="Edit Template Layanan">
                <x-slot name="header">
                    <x-admin.button href="{{ route('admin.service-templates.index') }}" variant="secondary">
                        Kembali
                    </x-admin.button>
                </x-slot>
                    
                <form method="POST" action="{{ route('admin.service-templates.update', $template) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Name -->
                        <div>
                            <x-admin.input 
                                type="text" 
                                name="name" 
                                id="name" 
                                label="Nama Template" 
                                value="{{ old('name', $template->name) }}" 
                                required 
                                :error="$errors->first('name')" 
                            />
                        </div>
                        
                        <!-- Current Template File -->
                        @if($template->file_path)
                        <div class="border p-4 rounded-md bg-gray-50">
                            <h3 class="font-medium text-gray-700 mb-2">File Template Saat Ini</h3>
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">{{ basename($template->file_path) }}</p>
                                    <a href="{{ route('admin.service-templates.download', $template) }}" class="text-sm text-jordy-blue-600 hover:text-jordy-blue-900">
                                        Download Template
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Template File -->
                        <div>
                            <x-admin.input 
                                type="file" 
                                name="template_file" 
                                id="template_file" 
                                label="Ganti File Template (Word)" 
                                accept=".doc,.docx" 
                                help="Format file: .doc atau .docx. Maksimal 5MB. Gunakan tanda @{{NAMA_VARIABEL}} untuk menandai bagian yang akan diganti." 
                                :error="$errors->first('template_file')" 
                            />
                        </div>
                        
                        <!-- Petunjuk Penggunaan Variabel -->
                        <div class="bg-blue-50 p-4 rounded-md border border-blue-200">
                            <h3 class="font-medium text-blue-800 mb-2">Petunjuk Penggunaan Variabel</h3>
                            <p class="text-sm text-blue-700 mb-2">Gunakan format <strong>@{{NAMA_VARIABEL}}</strong> di dalam dokumen Word untuk menandai bagian yang akan diganti dengan data yang diisi.</p>
                        </div>
                        
                        <!-- Variabel Repeater -->
                        <div>
                            <label class="block text-sm font-medium text-jordy-blue-900 mb-2">Variabel Template</label>
                            
                            @if($errors->has('variable_marks.*') || $errors->has('variable_descriptions.*'))
                                <div class="bg-red-50 p-3 rounded-md border border-red-200 mb-3">
                                    <p class="text-sm text-red-600">Terdapat kesalahan pada variabel template. Silakan periksa kembali.</p>
                                </div>
                            @endif
                            
                            <div id="variables-container" class="space-y-3">
                                @php
                                    $variables = old('variable_marks') ? array_combine(old('variable_marks', []), old('variable_descriptions', [])) : ($template->variables ?? [
                                        'NAMA_PEMOHON' => 'Nama lengkap pemohon',
                                        'NIK' => 'Nomor Induk Kependudukan',
                                        'ALAMAT' => 'Alamat lengkap'
                                    ]);
                                @endphp
                                
                                @forelse($variables as $mark => $description)
                                    <div class="variable-row grid grid-cols-12 gap-3 items-start">
                                        <div class="col-span-5">
                                            <x-admin.input 
                                                type="text" 
                                                name="variable_marks[]" 
                                                placeholder="NAMA_VARIABEL" 
                                                value="{{ $mark }}" 
                                                :error="$errors->first('variable_marks.' . $loop->index)" 
                                            />
                                        </div>
                                        <div class="col-span-6">
                                            <x-admin.input 
                                                type="text" 
                                                name="variable_descriptions[]" 
                                                placeholder="Deskripsi variabel" 
                                                value="{{ $description }}" 
                                                :error="$errors->first('variable_descriptions.' . $loop->index)" 
                                            />
                                        </div>
                                        <div class="col-span-1 flex items-center justify-center pt-2">
                                            <button type="button" class="text-red-500 hover:text-red-700 delete-variable {{ $loop->first && $loop->count == 1 ? 'hidden' : '' }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="variable-row grid grid-cols-12 gap-3 items-start">
                                        <div class="col-span-5">
                                            <x-admin.input 
                                                type="text" 
                                                name="variable_marks[]" 
                                                placeholder="NAMA_VARIABEL" 
                                                value="NAMA_PEMOHON" 
                                                :error="$errors->first('variable_marks.0')" 
                                            />
                                        </div>
                                        <div class="col-span-6">
                                            <x-admin.input 
                                                type="text" 
                                                name="variable_descriptions[]" 
                                                placeholder="Deskripsi variabel" 
                                                value="Nama lengkap pemohon" 
                                                :error="$errors->first('variable_descriptions.0')" 
                                            />
                                        </div>
                                        <div class="col-span-1 flex items-center justify-center pt-2">
                                            <button type="button" class="text-red-500 hover:text-red-700 delete-variable hidden">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            
                            <div class="mt-3">
                                <button type="button" id="add-variable" class="inline-flex items-center px-3 py-1.5 border border-jordy-blue-300 text-sm leading-5 font-medium rounded-md text-jordy-blue-700 bg-white hover:bg-jordy-blue-50 focus:outline-none focus:border-jordy-blue-300 focus:shadow-outline-jordy-blue active:bg-jordy-blue-100 transition ease-in-out duration-150">
                                    <svg class="-ml-1 mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Tambah Variabel
                                </button>
                            </div>
                        </div>
                        

                        
                        <!-- Status -->
                        <div>
                            <x-admin.checkbox 
                                name="is_active" 
                                id="is_active" 
                                label="Template Aktif" 
                                :checked="old('is_active', $template->is_active)" 
                                :error="$errors->first('is_active')" 
                            />
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <x-admin.button type="submit" variant="primary">
                            Perbarui Template
                        </x-admin.button>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>
@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('variables-container');
            const addButton = document.getElementById('add-variable');
            
            if (!container || !addButton) {
                console.error('Container atau tombol tambah variabel tidak ditemukan');
                return;
            }
            
            // Fungsi untuk menambah baris variabel baru
            addButton.addEventListener('click', function() {
                const rows = container.querySelectorAll('.variable-row');
                const newIndex = rows.length;
                
                const newRow = document.createElement('div');
                newRow.className = 'variable-row grid grid-cols-12 gap-3 items-start';
                newRow.innerHTML = `
                    <div class="col-span-5">
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" name="variable_marks[]" placeholder="NAMA_VARIABEL" 
                                   class="form-input block w-full sm:text-sm sm:leading-5 rounded-md transition duration-150 ease-in-out" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" name="variable_descriptions[]" placeholder="Deskripsi variabel" 
                                   class="form-input block w-full sm:text-sm sm:leading-5 rounded-md transition duration-150 ease-in-out" />
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center pt-2">
                        <button type="button" class="text-red-500 hover:text-red-700 delete-variable">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                `;
                
                container.appendChild(newRow);
                setupDeleteButtons();
            });
            
            // Fungsi untuk mengatur tombol hapus
            function setupDeleteButtons() {
                const deleteButtons = document.querySelectorAll('.delete-variable');
                deleteButtons.forEach(button => {
                    // Hapus event listener lama jika ada
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);
                    
                    // Tambahkan event listener baru
                    newButton.addEventListener('click', function() {
                        const row = this.closest('.variable-row');
                        if (container.querySelectorAll('.variable-row').length > 1) {
                            row.remove();
                            updateDeleteButtons();
                        }
                    });
                });
                
                updateDeleteButtons();
            }
            
            // Fungsi untuk memperbarui tampilan tombol hapus
            function updateDeleteButtons() {
                const rows = container.querySelectorAll('.variable-row');
                const firstDeleteButton = container.querySelector('.variable-row:first-child .delete-variable');
                
                if (rows.length > 1) {
                    firstDeleteButton.classList.remove('hidden');
                } else {
                    firstDeleteButton.classList.add('hidden');
                }
            }
            
            // Setup awal
            setupDeleteButtons();
        });
    </script>
@endsection

</x-admin-layout>