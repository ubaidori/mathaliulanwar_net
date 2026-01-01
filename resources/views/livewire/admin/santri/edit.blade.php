<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6" x-data="{ activeTab: 'pribadi' }">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Edit Data Santri</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Memperbarui informasi santri: <span class="font-semibold text-zinc-700 dark:text-zinc-300">{{ $name }}</span>
            </p>
        </div>
        
        <a href="{{ route('admin.santri.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="update">
        
        <div class="mb-6 border-b border-zinc-200 dark:border-zinc-800">
            <nav class="-mb-px flex space-x-6 overflow-x-auto" aria-label="Tabs">
                <button type="button" @click="activeTab = 'pribadi'"
                    :class="activeTab === 'pribadi' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Data Pribadi
                </button>

                <button type="button" @click="activeTab = 'ortu'"
                    :class="activeTab === 'ortu' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Orang Tua
                </button>

                <button type="button" @click="activeTab = 'wali'"
                    :class="activeTab === 'wali' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Wali Santri
                </button>

                <button type="button" @click="activeTab = 'akademik'"
                    :class="activeTab === 'akademik' 
                        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' 
                        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Pondok & Status
                </button>
            </nav>
        </div>

        <x-card class="p-6 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 min-h-[400px]">

            <div x-show="activeTab === 'pribadi'" class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-300">

                <div class="bg-zinc-50 dark:bg-zinc-800/50 p-4 rounded-xl border border-zinc-200 dark:border-zinc-700 flex flex-col md:flex-row gap-6">
                    <div class="shrink-0 flex justify-center md:justify-start">
                        <div class="relative group">
                            @if ($photo)
                                {{-- Case: Ada Upload Baru --}}
                                <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-40 object-cover rounded-lg shadow-sm border border-indigo-200 dark:border-indigo-700">
                                <span class="absolute inset-x-0 bottom-0 bg-indigo-600 text-white text-[10px] uppercase font-bold text-center py-1 rounded-b-lg opacity-90">Preview Baru</span>
                            
                            @elseif ($old_photo)
                                {{-- Case: Foto Lama Ada --}}
                                <img src="{{ asset('storage/' . $old_photo) }}" class="w-32 h-40 object-cover rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-600">
                                <span class="absolute inset-x-0 bottom-0 bg-zinc-800/80 text-white text-[10px] uppercase font-bold text-center py-1 rounded-b-lg">Foto Saat Ini</span>
                            
                            @else
                                {{-- Case: Kosong --}}
                                <div class="w-32 h-40 bg-zinc-200 dark:bg-zinc-800 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 flex flex-col items-center justify-center text-zinc-400 dark:text-zinc-500">
                                    <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs">No Photo</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex-1 space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Ganti Foto (Opsional)</label>
                            <input wire:model="photo" type="file" accept="image/*" 
                                class="block w-full text-sm text-zinc-500 dark:text-zinc-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-zinc-900 file:text-white
                                hover:file:bg-zinc-700
                                dark:file:bg-zinc-100 dark:file:text-zinc-900
                                cursor-pointer">
                            <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto profil.</p>
                            @error('photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">NIS</label>
                        <input wire:model="nis" type="number" class="input-flux">
                        @error('nis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Lengkap</label>
                        <input wire:model="name" type="text" class="input-flux">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
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
                    <textarea wire:model="address" rows="3" class="input-flux"></textarea>
                </div>
            </div>

            <div x-show="activeTab === 'ortu'" class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-300" style="display: none;">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <h4 class="font-bold text-zinc-900 dark:text-zinc-100 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-2">
                            <span class="text-blue-500">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            Data Ayah
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-medium text-zinc-500 uppercase">Nama Ayah</label>
                                <input wire:model="father_name" type="text" class="input-flux">
                            </div>
                            <div>
                                <label class="text-xs font-medium text-zinc-500 uppercase">No. Handphone</label>
                                <input wire:model="father_phone" type="text" class="input-flux">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-bold text-zinc-900 dark:text-zinc-100 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-2">
                            <span class="text-pink-500">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            Data Ibu
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-medium text-zinc-500 uppercase">Nama Ibu</label>
                                <input wire:model="mother_name" type="text" class="input-flux">
                            </div>
                            <div>
                                <label class="text-xs font-medium text-zinc-500 uppercase">No. Handphone</label>
                                <input wire:model="mother_phone" type="text" class="input-flux">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'wali'" class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-300" style="display: none;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Wali</label>
                        <input wire:model="guardian_name" type="text" class="input-flux">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Hubungan dengan Santri</label>
                        <input wire:model="guardian_relationship" type="text" placeholder="Contoh: Paman, Kakek" class="input-flux">
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'akademik'" class="space-y-8 animate-in fade-in slide-in-from-bottom-2 duration-300" style="display: none;">
                
                <div class="space-y-6">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Penempatan Saat Ini</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Asrama</label>
                            <select wire:model="dorm_id" class="input-flux">
                                <option value="">-- Pilih Asrama --</option>
                                @foreach($dorms as $d)
                                    <option value="{{ $d->id }}">Blok {{ $d->block }} - {{ $d->room_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Kelas Diniyah</label>
                            <select wire:model="islamic_class_id" class="input-flux">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }} {{ $c->class }}{{ $c->sub_class }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="border-t border-zinc-200 dark:border-zinc-700"></div>

                <div class="bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 rounded-xl p-6">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg shrink-0">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-red-800 dark:text-red-300">Status Kelulusan / Boyong</h4>
                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">
                                Isi bagian ini <strong>HANYA JIKA</strong> santri telah lulus, pindah, atau berhenti (Non-Aktif).
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-red-800 dark:text-red-300">Tanggal Keluar (Boyong)</label>
                            <input wire:model="drop_date" type="date" class="block w-full rounded-lg border-red-200 dark:border-red-900 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-2.5 px-3">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-red-800 dark:text-red-300">Alasan Keluar</label>
                            <input wire:model="drop_reason" type="text" placeholder="Misal: Lulus, Pindah Sekolah, Sakit" class="block w-full rounded-lg border-red-200 dark:border-red-900 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-2.5 px-3">
                        </div>
                    </div>
                </div>

            </div>

        </x-card>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold text-sm rounded-lg hover:bg-zinc-800 dark:hover:bg-zinc-200 transition shadow-lg gap-2">
                <span wire:loading.remove>Simpan Perubahan</span>
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
    </style>
</div>