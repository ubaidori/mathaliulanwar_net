<div class="max-w-6xl mx-auto" x-data="{ showModal: @entangle('isEdit') }"> <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>
        
        <button @click="$wire.resetInput(); showModal = true" class="bg-emerald-500 text-white px-4 py-2 rounded-lg">
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
                        <button wire:click="edit({{ $u->id }})" class="text-blue-600 mr-2">Edit</button>
                        <button wire:click="delete({{ $u->id }})" class="text-red-600" wire:confirm="Hapus?">Hapus</button>
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
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-500">Tutup</button>
                    <button type="submit" class="bg-pesantren-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>