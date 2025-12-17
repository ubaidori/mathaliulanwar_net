<div class="max-w-6xl mx-auto" 
        x-data="{ showModal: false }"
        x-on:open-modal.window="showModal = true" 
        x-on:close-modal.window="showModal = false">
    
        <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>
        
        <button wire:click="create" class="bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition shadow-lg cursor-pointer">
            + Tambah User
        </button>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $u)
                <tr>
                    <td class="px-6 py-4">{{ $u->name }}</td>
                    <td class="px-6 py-4">{{ $u->email }}</td>
                    <td class="px-6 py-4">
                        @foreach($u->roles as $role)
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full uppercase font-bold">
                                {{ str_replace('_', ' ', $role->name) }}
                            </span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{ $u->id }})" class="text-blue-500 hover:text-blue-700 p-2 rounded-full hover:bg-blue-100 transition duration-150 cursor-pointer">
                            <svg xmlns="www.w3.org" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>

                        <button wire:click="delete({{ $u->id }})" wire:confirm="Hapus user ini?" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition duration-150 cursor-pointer">
                            <svg xmlns="www.w3.org" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="bg-white w-full max-w-md rounded-lg p-6">
            <h3 class="font-bold text-lg mb-4">{{ $isEdit ? 'Edit User' : 'Buat User Baru' }}</h3>
            
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <input wire:model="name" type="text" placeholder="Nama Lengkap" class="w-full border rounded p-2">
                <input wire:model="email" type="email" placeholder="Email Login" class="w-full border rounded p-2">
                <input wire:model="password" type="password" placeholder="Password (Kosongkan jika tidak ubah)" class="w-full border rounded p-2">
                
                <select wire:model="role" class="w-full border rounded p-2">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->name }}">{{ ucfirst(str_replace('_', ' ', $r->name)) }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 border border-gray-300 bg-gray-300 hover:bg-gray-400 text-gray-500 rounded">Tutup</button>
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>