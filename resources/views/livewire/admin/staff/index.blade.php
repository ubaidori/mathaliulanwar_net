<div x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Guru & Staff</h2>
            <p class="text-sm text-gray-500">Manajemen pengajar dan pengurus pondok.</p>
        </div>
        <button wire:click="create" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Staff
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-200">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Nama Guru..." 
               class="w-full md:w-1/3 px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-pesantren-500 outline-none">
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">Nama & Foto</th>
                    <th class="px-6 py-4">NIP / NIY</th>
                    <th class="px-6 py-4">Jabatan</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($staffs as $staff)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full overflow-hidden border border-gray-200 bg-gray-100 shrink-0">
                                @if($staff->photo)
                                    <img src="{{ asset('storage/' . $staff->photo) }}" class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="font-bold text-gray-800">{{ $staff->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $staff->nip ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold">{{ $staff->position }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($staff->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Non-Aktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button wire:click="edit({{ $staff->id }})" class="text-blue-600 hover:text-blue-800 font-medium">Edit</button>
                        <button wire:click="delete({{ $staff->id }})" wire:confirm="Hapus data ini?" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $staffs->links() }}
    </div>

    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
         style="display: none;">
        
        <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl p-6 border border-gray-200">
            <h3 class="text-xl font-bold mb-4 text-gray-800">
                {{ $isEdit ? 'Edit Data Guru' : 'Tambah Guru Baru' }}
            </h3>
            
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap (Gelar)</label>
                    <input wire:model="name" type="text" class="w-full rounded-lg border p-2 border-gray-300 focus:ring-pesantren-500">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP / NIY</label>
                        <input wire:model="nip" type="text" class="w-full rounded-lg border border-gray-300 p-2 focus:ring-pesantren-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input wire:model="position" type="text" placeholder="Misal: Wali Kelas I.1 PA Awwaliyah" class="w-full rounded-lg border border-gray-300  p-2 focus:ring-pesantren-500">
                        @error('position') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <input wire:model="phone" type="text" class="w-full rounded-lg border border-gray-300 px-2 py-[1] focus:ring-pesantren-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Keaktifan</label>
                        <select wire:model="is_active" class="w-full rounded-lg border border-gray-300 px-2 py-[1] focus:ring-pesantren-500">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        <div class="shrink-0">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="h-16 w-16 object-cover rounded-full border border-gray-300">
                            @elseif($old_photo)
                                <img src="{{ asset('storage/'.$old_photo) }}" class="h-16 w-16 object-cover rounded-full border border-gray-300">
                            @else
                                <div class="h-16 w-16 bg-gray-100 rounded-full border flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <input wire:model="photo" type="file" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-full file:mr-4 file:py-2 file:px-4 file:rounded-l-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-pesantren-700 hover:file:bg-gray-200 file:cursor-pointer">
                    </div>
                    @error('photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-500 border border-gray-300 rounded-lg bg-gray-100 hover:text-gray-700">Batal</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow cursor-pointer">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>