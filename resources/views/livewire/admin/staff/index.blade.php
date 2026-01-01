<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6" 
     x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Data Guru & Staff</h2>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Kelola data pengajar dan karyawan pondok.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm transition-colors focus:ring-4 focus:ring-indigo-500/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Staff Baru</span>
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 p-4 border border-emerald-200 dark:border-emerald-800 flex items-center gap-3">
            <div class="shrink-0 text-emerald-500">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            </div>
            <p class="text-sm font-medium text-emerald-800 dark:text-emerald-200">{{ session('message') }}</p>
        </div>
    @endif

    <div class="mb-6 relative max-w-md">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </div>
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari berdasarkan nama atau NIP..." 
               class="block w-full pl-10 pr-3 py-2.5 border border-zinc-300 dark:border-zinc-700 rounded-lg leading-5 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm shadow-sm transition-shadow">
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-100 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Identitas</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Jabatan & NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-zinc-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800 bg-white dark:bg-zinc-900">
                    @forelse($staffs as $staff)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-11 w-11 shrink-0">
                                    @if($staff->photo)
                                        <img class="h-11 w-11 rounded-full object-cover border border-zinc-200 dark:border-zinc-700" src="{{ asset('storage/' . $staff->photo) }}" alt="">
                                    @else
                                        <div class="h-11 w-11 rounded-full bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm border border-indigo-100 dark:border-indigo-800">
                                            {{ substr($staff->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $staff->name }}</div>
                                    <div class="text-xs text-zinc-500">{{ $staff->phone ?? 'No. HP belum diisi' }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $staff->position }}</span>
                                <span class="text-xs text-zinc-400 font-mono mt-0.5">{{ $staff->nip ?? 'NIP: -' }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($staff->is_active)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span>
                                    Non-Aktif
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <button wire:click="edit({{ $staff->id }})" class="p-1.5 text-zinc-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button wire:click="delete({{ $staff->id }})" wire:confirm="Yakin ingin menghapus data staff ini? Aksi ini tidak dapat dibatalkan." class="p-1.5 text-zinc-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-zinc-500">
                            Tidak ada data staff yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $staffs->links() }}
    </div>

    <div x-show="showModal" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-zinc-900/70 backdrop-blur-sm transition-opacity" @click="showModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="relative inline-block align-bottom bg-white dark:bg-zinc-900 rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-zinc-200 dark:border-zinc-800">
                
                <div class="px-6 py-5 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">
                        {{ $isEdit ? 'Edit Data Staff' : 'Tambah Staff Baru' }}
                    </h3>
                    <button @click="showModal = false" class="text-zinc-400 hover:text-zinc-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="px-6 py-6 space-y-5">
                        
                        <div>
                            <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Nama Lengkap & Gelar</label>
                            <input wire:model="name" type="text" class="input-flux" placeholder="Contoh: Ahmad Fauzan, S.Pd.">
                            @error('name') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">NIP / NIY</label>
                                <input wire:model="nip" type="text" class="input-flux">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Jabatan Utama</label>
                                <input wire:model="position" type="text" class="input-flux" placeholder="Wali Kelas...">
                                @error('position') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Nomor HP / WA</label>
                                <input wire:model="phone" type="text" class="input-flux" placeholder="08...">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Status Aktif</label>
                                <select wire:model="is_active" class="input-flux">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2">Foto Profil</label>
                            <div class="flex items-center gap-4 p-3 border border-dashed border-zinc-300 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800/50">
                                <div class="shrink-0">
                                    @if ($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" class="h-14 w-14 object-cover rounded-full border border-zinc-200">
                                    @elseif($old_photo)
                                        <img src="{{ asset('storage/'.$old_photo) }}" class="h-14 w-14 object-cover rounded-full border border-zinc-200">
                                    @else
                                        <div class="h-14 w-14 bg-white dark:bg-zinc-800 rounded-full border border-zinc-200 dark:border-zinc-700 flex items-center justify-center text-zinc-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-full">
                                    <input wire:model="photo" type="file" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition file:cursor-pointer">
                                    <p class="text-[10px] text-zinc-400 mt-1">Format: JPG, PNG. Maks 2MB.</p>
                                </div>
                            </div>
                            @error('photo') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        @if(!$isEdit) 
                        <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <div class="relative inline-flex items-center">
                                    <input wire:model.live="make_account" type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-zinc-600 peer-checked:bg-indigo-600"></div>
                                </div>
                                <span class="text-sm font-bold text-zinc-800 dark:text-zinc-200">Buat Akun Login Sistem?</span>
                            </label>
                            
                            @if($make_account)
                                <div class="mt-3 pt-3 border-t border-indigo-200 dark:border-indigo-800/50">
                                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Email Login</label>
                                    <input wire:model="email" type="email" placeholder="guru@pesantren.com" class="input-flux border-indigo-200 focus:border-indigo-500">
                                    @error('email') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    <p class="text-xs text-indigo-600/70 mt-1.5 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Password default: <strong>password</strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                        @endif

                    </div>

                    <div class="px-6 py-4 bg-zinc-50 dark:bg-zinc-800/50 flex justify-end gap-3 border-t border-zinc-100 dark:border-zinc-800">
                        <button type="button" @click="showModal = false" class="px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 rounded-lg hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors flex items-center gap-2">
                            <span wire:loading.remove>{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .input-flux {
            @apply block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 transition duration-150;
        }
    </style>
</div>