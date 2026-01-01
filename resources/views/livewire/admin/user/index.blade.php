<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Manajemen Pengguna</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Kelola data akses login guru dan staf akademik.</p>
        </div>
        
        <button wire:click="create" class="inline-flex items-center justify-center px-4 py-2 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 text-sm font-medium rounded-lg hover:bg-zinc-800 dark:hover:bg-zinc-100 transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah User
        </button>
    </div>

    <x-card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($users as $u)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-zinc-900 dark:text-white">{{ $u->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ $u->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2 flex-wrap">
                                @foreach($u->roles as $role)
                                    @php
                                        $color = match($role->name) {
                                            'super_admin' => 'purple',
                                            'admin_akademik' => 'blue',
                                            'guru' => 'green',
                                            default => 'gray',
                                        };
                                    @endphp
                                    <x-badge :color="$color">
                                        {{ str_replace('_', ' ', $role->name) }}
                                    </x-badge>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <button wire:click="edit({{ $u->id }})" class="text-zinc-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button 
                                    wire:click="delete({{ $u->id }})" 
                                    wire:confirm="Hapus user ini? Tindakan ini tidak dapat dibatalkan."
                                    class="text-zinc-400 hover:text-red-600 dark:hover:text-red-400 transition"
                                >
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-zinc-500 dark:text-zinc-400">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <x-modal name="user-modal" :title="$isEdit ? 'Edit User' : 'Buat User Baru'">
        <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
            
            <x-input 
                wire:model="name" 
                label="Nama Lengkap" 
                placeholder="Contoh: Ahmad Dahlan"
                :error="$errors->first('name')" 
            />

            <x-input 
                wire:model="email" 
                type="email" 
                label="Email Login" 
                placeholder="nama@sekolah.com"
                :error="$errors->first('email')"
            />

            <x-input 
                wire:model="password" 
                type="password" 
                label="Password" 
                placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
                :error="$errors->first('password')"
            />

            <div class="space-y-1">
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Role / Jabatan</label>
                <select wire:model="role" class="block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3">
                    <option value="">Pilih hak akses...</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->name }}">{{ ucfirst(str_replace('_', ' ', $r->name)) }}</option>
                    @endforeach
                </select>
                @error('role') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                <button 
                    type="button" 
                    x-on:click="$dispatch('close-modal', { name: 'user-modal' })"
                    class="px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-700"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2 text-sm font-medium text-white bg-zinc-900 border border-transparent rounded-lg hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200"
                >
                    Simpan
                </button>
            </div>
        </form>
    </x-modal>

</div>