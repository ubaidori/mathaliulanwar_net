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