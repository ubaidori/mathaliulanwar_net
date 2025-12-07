<div class="max-w-5xl mx-auto" x-data="{ activeTab: 'pribadi' }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pendaftaran Santri Baru</h2>
            <p class="text-sm text-gray-500">Isi formulir lengkap data santri.</p>
        </div>
        <a href="{{ route('admin.santri.index') }}" class="text-gray-600 hover:text-gray-800">
            &larr; Kembali
        </a>
    </div>

    <form wire:submit="store">
        
        <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200 pb-1">
            <button type="button" @click="activeTab = 'pribadi'"
                :class="activeTab === 'pribadi' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50/20' : 'border-transparent text-gray-500 hover:text-gray-700-300'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Data Pribadi
            </button>
            
            <button type="button" @click="activeTab = 'ortu'"
                :class="activeTab === 'ortu' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50/20' : 'border-transparent text-gray-500 hover:text-gray-700-300'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Orang Tua
            </button>

            <button type="button" @click="activeTab = 'wali'"
                :class="activeTab === 'wali' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50/20' : 'border-transparent text-gray-500 hover:text-gray-700-300'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Wali Santri
            </button>

            <button type="button" @click="activeTab = 'akademik'"
                :class="activeTab === 'akademik' ? 'border-pesantren-500 text-pesantren-600 bg-pesantren-50/20' : 'border-transparent text-gray-500 hover:text-gray-700-300'"
                class="px-4 py-2 border-b-2 font-medium text-sm transition rounded-t-lg">
                Pondok & Akademik
            </button>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">

            <div x-show="activeTab === 'pribadi'" class="space-y-4">

                <h3 class="font-bold text-gray-800-b pb-2 mb-4">Informasi Dasar</h3>

                <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col md:flex-row gap-6 items-start">
                    
                    <div class="shrink-0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pas Foto</label>
                        
                        @if ($photo)
                            <div class="relative">
                                <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-44 object-cover rounded-lg shadow-sm border border-gray-300">
                                <button type="button" wire:click="$set('photo', null)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        @else
                            <div class="w-32 h-44 bg-gray-200 rounded-lg border-2 border-dashed border-gray-400 flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-semibold">Upload</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload File</label>
                        <input wire:model="photo" type="file" accept="image/*" 
                            class="block w-full text-sm text-gray-500 border border-gray-300 rounded-full file:mr-4 file:py-2 file:px-4 file:rounded-l-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-400 file:cursor-pointer cursor-pointer">
                        @error('photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                        <div class="mt-4 p-3 bg-blue-50 text-blue-800 text-sm rounded border border-blue-100 flex items-start gap-2">
                            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <strong>Ketentuan Foto:</strong>
                                <ul class="list-disc ml-4 mt-1 text-xs space-y-1">
                                    <li>Rasio foto wajib <strong>3:4 (Portrait)</strong> agar tampilan rapi.</li>
                                    <li>Latar belakang (background) polos (Merah/Biru/Putih).</li>
                                    <li>Format file: JPG, JPEG, atau PNG.</li>
                                    <li>Ukuran maksimal file: 2 MB.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm">NIS (Nomor Induk Santri)</label>
                        <input wire:model="nis" type="number" class="input-form border border-gray-300">
                        @error('nis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm">NISN (Nasional)</label>
                        <input wire:model="nisn" type="number" class="input-form border border-gray-300">
                    </div>
                </div>

                <div>
                    <label class="block text-sm">Nama Lengkap</label>
                    <input wire:model="name" type="text" class="input-form border border-gray-300">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm">Jenis Kelamin</label>
                        <select wire:model="gender" class="input-form border border-gray-300">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm">Tanggal Lahir</label>
                        <input wire:model="dob" type="date" class="input-form border border-gray-300">
                    </div>
                </div>

                <div>
                    <label class="block text-sm">Alamat Lengkap</label>
                    <textarea wire:model="address" rows="3" class="input-form border border-gray-300"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm">Anak Ke-</label>
                        <input wire:model="th_child" type="number" class="input-form border border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm">Jml Saudara</label>
                        <input wire:model="siblings_count" type="number" class="input-form border border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm">Pendidikan Terakhir</label>
                        <select wire:model="education" class="input-form border border-gray-300">
                            <option value="">Pilih...</option>
                            <option value="SD/MI">SD/MI</option>
                            <option value="SMP/MTs">SMP/MTs</option>
                            <option value="SMA/MA">SMA/MA</option>
                        </select>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'ortu'" style="display: none;">
                
                <div class="mb-8">
                    <h3 class="font-bold text-pesantren-600 border-b pb-2 mb-4">Data Ayah</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm">Nama Ayah</label>
                            <input wire:model="father_name" type="text" class="input-form border border-gray-300">
                        </div>
                        <div>
                            <label class="text-sm">Status</label>
                            <select wire:model="father_alive" class="input-form border border-gray-300">
                                <option value="Hidup">Hidup</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm">Pekerjaan</label>
                            <input wire:model="father_job" type="text" class="input-form border border-gray-300">
                        </div>
                        <div>
                            <label class="text-sm">No. HP</label>
                            <input wire:model="father_phone" type="text" class="input-form border border-gray-300">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-pink-600 border-b pb-2 mb-4">Data Ibu</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm">Nama Ibu</label>
                            <input wire:model="mother_name" type="text" class="input-form border border-gray-300">
                        </div>
                        <div>
                            <label class="text-sm">Status</label>
                            <select wire:model="mother_alive" class="input-form border border-gray-300">
                                <option value="Hidup">Hidup</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm">Pekerjaan</label>
                            <input wire:model="mother_job" type="text" class="input-form border border-gray-300">
                        </div>
                        <div>
                            <label class="text-sm">No. HP</label>
                            <input wire:model="mother_phone" type="text" class="input-form border border-gray-300">
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'wali'" style="display: none;" class="space-y-4">
                <h3 class="font-bold text-gray-800-b pb-2 mb-4">Data Wali (Opsional)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Nama Wali</label>
                        <input wire:model="guardian_name" type="text" class="input-form border border-gray-300">
                    </div>
                    <div>
                        <label class="text-sm">Hubungan</label>
                        <input wire:model="guardian_relationship" type="text" placeholder="Misal: Paman, Kakek" class="input-form border border-gray-300">
                    </div>
                    <div>
                        <label class="text-sm">Pekerjaan</label>
                        <input wire:model="guardian_job" type="text" class="input-form border border-gray-300">
                    </div>
                    <div>
                        <label class="text-sm">No. HP</label>
                        <input wire:model="guardian_phone" type="text" class="input-form border border-gray-300">
                    </div>
                </div>
                <div>
                    <label class="text-sm">Alamat Wali</label>
                    <textarea wire:model="guardian_address" rows="2" class="input-form border border-gray-300"></textarea>
                </div>
            </div>

            <div x-show="activeTab === 'akademik'" style="display: none;" class="space-y-4">
                <h3 class="font-bold text-gray-800-b pb-2 mb-4">Penempatan Santri</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Tanggal Masuk</label>
                        <input wire:model="registration_date" type="date" class="input-form border border-gray-300">
                        @error('registration_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="text-sm">Kamar Asrama</label>
                        <select wire:model="dorm_id" class="input-form border border-gray-300">
                            <option value="">-- Pilih Kamar --</option>
                            @foreach($dorms as $dorm)
                                <option value="{{ $dorm->id }}">
                                    Blok {{ $dorm->block }} - No. {{ $dorm->room_number }} ({{ ucfirst($dorm->zone) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm">Kelas Diniyah</label>
                        <select wire:model="islamic_class_id" class="input-form border border-gray-300">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $kls)
                                <option value="{{ $kls->id }}">
                                    {{ $kls->name }} - {{ $kls->class }} {{ $kls->sub_class }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6 flex justify-between items-center bg-gray-50 p-4 rounded-lg border border-gray-200">
            <p class="text-xs text-gray-500 italic">Pastikan data sudah benar sebelum disimpan.</p>
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg flex items-center gap-2">
                <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <svg wire:loading class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Simpan Data
            </button>
        </div>

    </form>
    {{-- CSS Helper untuk Input Form agar kodenya tidak berulang-ulang --}}
    <style>
        .input-form {
            @apply w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:ring-2 focus:ring-pesantren-500 focus:border-pesantren-500 transition duration-150;
        }
    </style>
</div>
