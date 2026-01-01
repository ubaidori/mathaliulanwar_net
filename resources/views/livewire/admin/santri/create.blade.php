<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6" x-data="{ activeTab: 'pribadi' }">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Pendaftaran Santri Baru</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Lengkapi formulir di bawah ini untuk mendaftarkan santri.</p>
        </div>
        
        <a href="{{ route('admin.santri.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="store">
        
        <div class="mb-6 border-b border-zinc-200 dark:border-zinc-800">
            <nav class="-mb-px flex space-x-6 overflow-x-auto" aria-label="Tabs">
                <button type="button" @click="activeTab = 'pribadi'"
                    :class="activeTab === 'pribadi' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    1. Data Pribadi
                </button>

                <button type="button" @click="activeTab = 'ortu'"
                    :class="activeTab === 'ortu' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    2. Orang Tua
                </button>

                <button type="button" @click="activeTab = 'wali'"
                    :class="activeTab === 'wali' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    3. Wali Santri
                </button>

                <button type="button" @click="activeTab = 'akademik'"
                    :class="activeTab === 'akademik' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    4. Pondok & Akademik
                </button>
            </nav>
        </div>

        <x-card class="p-6 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 min-h-[400px]">

            <div x-show="activeTab === 'pribadi'" class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-300">
                
                <div class="bg-zinc-50 dark:bg-zinc-800/50 p-4 rounded-xl border border-zinc-200 dark:border-zinc-700 flex flex-col md:flex-row gap-6">
                    <div class="shrink-0 flex justify-center md:justify-start">
                        @if ($photo)
                            <div class="relative group">
                                <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-40 object-cover rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600">
                                <button type="button" wire:click="$set('photo', null)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600 transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        @else
                            <div class="w-32 h-40 bg-zinc-200 dark:bg-zinc-800 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 flex flex-col items-center justify-center text-zinc-400 dark:text-zinc-500">
                                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-medium">No Photo</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Upload Pas Foto</label>
                            <input wire:model="photo" type="file" accept="image/*" 
                                class="block w-full text-sm text-zinc-500 dark:text-zinc-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-zinc-900 file:text-white
                                hover:file:bg-zinc-700
                                dark:file:bg-zinc-100 dark:file:text-zinc-900
                                cursor-pointer">
                            @error('photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-xs text-zinc-500 dark:text-zinc-400 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 p-3 rounded-lg border border-blue-100 dark:border-blue-800">
                            <strong>Ketentuan:</strong> Rasio 3:4 (Portrait), Latar belakang polos, Format JPG/PNG, Maks. 2MB.
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">NIS (Nomor Induk Santri)</label>
                        <input wire:model="nis" type="number" class="input-flux" placeholder="Contoh: 2024001">
                        @error('nis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">NISN (Nasional)</label>
                        <input wire:model="nisn" type="number" class="input-flux" placeholder="Opsional">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Lengkap</label>
                    <input wire:model="name" type="text" class="input-flux" placeholder="Sesuai Akta Kelahiran">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Jenis Kelamin</label>
                        <select wire:model="gender" class="input-flux">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Tanggal Lahir</label>
                        <input wire:model="dob" type="date" class="input-flux">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Alamat Lengkap</label>
                    <textarea wire:model="address" rows="3" class="input-flux" placeholder="Nama Jalan, RT/RW, Desa, Kecamatan..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Anak Ke-</label>
                        <input wire:model="th_child" type="number" class="input-flux">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Jml Saudara</label>
                        <input wire:model="siblings_count" type="number" class="input-flux">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Pendidikan Terakhir</label>
                        <select wire:model="education" class="input-flux">
                            <option value="">Pilih...</option>
                            <option value="SD/MI">SD/MI</option>
                            <option value="SMP/MTs">SMP/MTs</option>
                            <option value="SMA/MA">SMA/MA</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end pt-4">
                    <button type="button" @click="activeTab = 'ortu'" class="btn-secondary">Lanjut: Data Orang Tua &rarr;</button>
                </div>
            </div>

            <div x-show="activeTab === 'ortu'" class="space-y-8 animate-in fade-in slide-in-from-bottom-2 duration-300" style="display: none;">
                
                <div>
                    <h3 class="font-bold text-zinc-900 dark:text-zinc-100 border-b border-zinc-200 dark:border-zinc-700 pb-2 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Data Ayah
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Ayah</label>
                            <input wire:model="father_name" type="text" class="input-flux">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Status</label>
                            <select wire:model="father_alive" class="input-flux">
                                <option value="Hidup">Hidup</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Pekerjaan</label>
                            <input wire:model="father_job" type="text" class="input-flux">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">No. HP</label>
                            <input wire:model="father_phone" type="text" class="input-flux">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-zinc-900 dark:text-zinc-100 border-b border-zinc-200 dark:border-zinc-700 pb-2 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Data Ibu
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Ibu</label>
                            <input wire:model="mother_name" type="text" class="input-flux">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Status</label>
                            <select wire:model="mother_alive" class="input-flux">
                                <option value="Hidup">Hidup</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Pekerjaan</label>
                            <input wire:model="mother_job" type="text" class="input-flux">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">No. HP</label>
                            <input wire:model="mother_phone" type="text" class="input-flux">
                        </div>
                    </div>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="activeTab = 'pribadi'" class="btn-text">&larr; Sebelumnya</button>
                    <button type="button" @click="activeTab = 'wali'" class="btn-secondary">Lanjut: Data Wali &rarr;</button>
                </div>
            </div>

            <div x-show="activeTab === 'wali'" class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-300" style="display: none;">
                <div class="flex items-start gap-4 mb-4 bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg text-yellow-800 dark:text-yellow-200 text-sm">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>Isi data wali jika santri tinggal bersama wali (bukan orang tua kandung) atau orang tua berada jauh dari pondok.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Wali</label>
                        <input wire:model="guardian_name" type="text" class="input-flux">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Hubungan</label>
                        <input wire:model="guardian_relationship" type="text" placeholder="Misal: Paman, Kakek" class="input-flux">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Pekerjaan</label>
                        <input wire:model="guardian_job" type="text" class="input-flux">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">No. HP</label>
                        <input wire:model="guardian_phone" type="text" class="input-flux">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Alamat Wali</label>
                    <textarea wire:model="guardian_address" rows="2" class="input-flux"></textarea>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="activeTab = 'ortu'" class="btn-text">&larr; Sebelumnya</button>
                    <button type="button" @click="activeTab = 'akademik'" class="btn-secondary">Lanjut: Akademik &rarr;</button>
                </div>
            </div>

            <div x-show="activeTab === 'akademik'" class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-300" style="display: none;">
                <h3 class="font-bold text-zinc-900 dark:text-zinc-100 border-b border-zinc-200 dark:border-zinc-700 pb-2 mb-4">
                    Penempatan Santri
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Tanggal Masuk</label>
                        <input wire:model="registration_date" type="date" class="input-flux">
                        @error('registration_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Kamar Asrama</label>
                        <select wire:model="dorm_id" class="input-flux">
                            <option value="">-- Pilih Kamar --</option>
                            @foreach($dorms as $dorm)
                                <option value="{{ $dorm->id }}">
                                    Blok {{ $dorm->block }} - No. {{ $dorm->room_number }} ({{ ucfirst($dorm->zone) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Kelas Diniyah</label>
                        <select wire:model="islamic_class_id" class="input-flux">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $kls)
                                <option value="{{ $kls->id }}">
                                    {{ $kls->name }} - {{ $kls->class }} {{ $kls->sub_class }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="activeTab = 'wali'" class="btn-text">&larr; Sebelumnya</button>
                    </div>
            </div>

        </x-card>

        <div class="mt-6 flex flex-col md:flex-row justify-between items-center bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 rounded-xl gap-4">
            <p class="text-xs text-zinc-500 dark:text-zinc-400 italic">
                Pastikan seluruh data pada semua tab telah terisi dengan benar sebelum menyimpan.
            </p>
            <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold text-sm rounded-lg hover:bg-zinc-800 dark:hover:bg-zinc-200 transition shadow-lg gap-2">
                <span wire:loading.remove>Simpan Data Santri</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Menyimpan...
                </span>
            </button>
        </div>

    </form>

    {{-- CSS Helpers --}}
    <style>
        .input-flux {
            @apply block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 transition duration-150;
        }
        .btn-secondary {
            @apply px-4 py-2 bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-200 rounded-lg text-sm font-medium hover:bg-zinc-200 dark:hover:bg-zinc-700 transition;
        }
        .btn-text {
            @apply px-4 py-2 text-zinc-500 dark:text-zinc-400 text-sm font-medium hover:text-zinc-900 dark:hover:text-zinc-200 transition;
        }
    </style>
</div>