<div x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Data Asrama</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola gedung dan kamar santri.</p>
        </div>
        <button wire:click="create" 
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
            + Tambah Asrama
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Blok</th>
                    <th class="px-6 py-4">No. Kamar</th>
                    <th class="px-6 py-4">Kapasitas</th>
                    <th class="px-6 py-4">Zona</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($dorms as $dorm)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800 dark:text-white">{{ $dorm->block }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $dorm->room_number }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $dorm->capacity }} Orang</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-bold uppercase
                            {{ $dorm->zone == 'putra' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300' : 'bg-pink-100 text-pink-700 dark:bg-pink-900 dark:text-pink-300' }}">
                            {{ $dorm->zone }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button wire:click="edit({{ $dorm->id }})" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">Edit</button>
                        <button wire:click="delete({{ $dorm->id }})" wire:confirm="Hapus asrama ini?" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-medium">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
         style="display: none;">
        
        <div class="bg-white dark:bg-gray-800 w-full max-w-md rounded-xl shadow-2xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">
                {{ $isEdit ? 'Edit Data Asrama' : 'Tambah Asrama Baru' }}
            </h3>
            
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Blok Gedung</label>
                    <input wire:model="block" type="text" placeholder="Misal: A" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-pesantren-500">
                    @error('block') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Kamar</label>
                        <input wire:model="room_number" type="number" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-pesantren-500">
                        @error('room_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kapasitas</label>
                        <input wire:model="capacity" type="number" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-pesantren-500">
                        @error('capacity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Zona</label>
                    <select wire:model="zone" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-pesantren-500">
                        <option value="putra">Putra</option>
                        <option value="putri">Putri</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-500 hover:text-gray-700 dark:text-gray-400">Batal</button>
                    <button type="submit" class="bg-pesantren-500 hover:bg-pesantren-600 text-white px-4 py-2 rounded-lg">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>