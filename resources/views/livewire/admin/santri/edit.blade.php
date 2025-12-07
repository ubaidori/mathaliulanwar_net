<div class="max-w-5xl mx-auto" x-data="{ activeTab: 'pribadi' }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Santri</h2>
            <p class="text-sm text-gray-500">Perbarui informasi santri.</p>
        </div>
        <a href="{{ route('admin.santri.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Kembali
        </a>
    </div>

    <form wire:submit="update">
        
        <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200 pb-1">
            <button type="button" @click="activeTab = 'pribadi'"
                :class="activeTab === 'pribadi' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Data Pribadi
            </button>
            <button type="button" @click="activeTab = 'ortu'"
                :class="activeTab === 'ortu' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Orang Tua
            </button>
            <button type="button" @click="activeTab = 'wali'"
                :class="activeTab === 'wali' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Wali Santri
            </button>
            <button type="button" @click="activeTab = 'akademik'"
                :class="activeTab === 'akademik' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Pondok & Mutasi
            </button>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">

            <div x-show="activeTab === 'pribadi'" class="space-y-4">

                <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col md:flex-row gap-6 items-start">
                    
                    <div class="shrink-0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pas Foto</label>
                        
                        <div class="relative">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-44 object-cover rounded-lg shadow-sm border border-gray-300">
                                <span class="absolute bottom-0 left-0 right-0 bg-blue-500 text-white text-xs text-center py-1 rounded-b-lg">Preview Baru</span>
                            
                            @elseif ($old_photo)
                                <img src="{{ asset('storage/' . $old_photo) }}" class="w-32 h-44 object-cover rounded-lg shadow-sm border border-gray-300">
                                <span class="absolute bottom-0 left-0 right-0 bg-gray-500 text-white text-xs text-center py-1 rounded-b-lg">Foto Saat Ini</span>
                            
                            @else
                                <div class="w-32 h-44 bg-gray-200 rounded-lg border-2 border-dashed border-gray-400 flex flex-col items-center justify-center text-gray-500">
                                    <span class="text-xs">Tidak ada foto</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto (Opsional)</label>
                        <input wire:model="photo" type="file" accept="image/*" 
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 border border-gray-300 rounded-full file:rounded-l-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-400 file:cursor-pointer cursor-pointer">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                        @error('photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                        <div class="mt-4 p-3 bg-blue-50 text-blue-800 text-sm rounded border border-blue-100">
                            <strong>Ketentuan Foto:</strong>
                            <ul class="list-disc ml-4 mt-1 text-xs space-y-1">
                                <li>Rasio <strong>3:4 (Portrait)</strong>.</li>
                                <li>Maksimal 2MB.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIS</label>
                        <input wire:model="nis" type="number" class="w-full rounded-lg border border-gray-300 focus:ring-pesantren-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input wire:model="name" type="text" class="w-full rounded-lg border border-gray-300 focus:ring-pesantren-500">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <select wire:model="gender" class="w-full rounded-lg border border-gray-300">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input wire:model="dob" type="date" class="w-full rounded-lg border border-gray-300">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea wire:model="address" rows="2" class="w-full rounded-lg border border-gray-300"></textarea>
                </div>
            </div>

            <div x-show="activeTab === 'ortu'" style="display: none;" class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-3">Data Ayah</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <input wire:model="father_name" placeholder="Nama Ayah" type="text" class="w-full rounded-lg border border-gray-300">
                        <input wire:model="father_phone" placeholder="No HP Ayah" type="text" class="w-full rounded-lg border border-gray-300">
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-3">Data Ibu</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <input wire:model="mother_name" placeholder="Nama Ibu" type="text" class="w-full rounded-lg border border-gray-300">
                        <input wire:model="mother_phone" placeholder="No HP Ibu" type="text" class="w-full rounded-lg border border-gray-300">
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'wali'" style="display: none;">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Wali</label>
                        <input wire:model="guardian_name" type="text" class="w-full rounded-lg border border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Hubungan</label>
                        <input wire:model="guardian_relationship" type="text" class="w-full rounded-lg border border-gray-300">
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'akademik'" style="display: none;" class="space-y-6">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Asrama</label>
                        <select wire:model="dorm_id" class="w-full rounded-lg border border-gray-300">
                            <option value="">-- Pilih --</option>
                            @foreach($dorms as $d)
                                <option value="{{ $d->id }}">{{ $d->block }} - {{ $d->room_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select wire:model="islamic_class_id" class="w-full rounded-lg border border-gray-300">
                            <option value="">-- Pilih --</option>
                            @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->name }} {{ $c->class }}{{ $c->sub_class }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mt-4">
                    <h4 class="text-red-600 font-bold mb-2 text-sm uppercase">Status Kelulusan / Boyong</h4>
                    <div class="grid grid-cols-2 gap-4 bg-red-50 p-4 rounded-lg border border-red-100">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Keluar (Boyong)</label>
                            <input wire:model="drop_date" type="date" class="w-full rounded-lg border-gray-300">
                            <p class="text-xs text-gray-500 mt-1">Isi hanya jika santri sudah tidak aktif.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alasan Keluar</label>
                            <input wire:model="drop_reason" type="text" placeholder="Misal: Lulus / Pindah" class="w-full rounded-lg border border-gray-300">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>