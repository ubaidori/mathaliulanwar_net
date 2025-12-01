<div x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Kelas Diniyah</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Master data kelas pendidikan.</p>
        </div>
        <button wire:click="create" 
                class="bg-emerald-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-emerald-600">
            + Tambah Kelas
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
                    <th class="px-6 py-4">Tingkat (Name)</th>
                    <th class="px-6 py-4">Kelas</th>
                    <th class="px-6 py-4">Sub Kelas</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($classes as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800 dark:text-white">{{ $item->name }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $item->class }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs font-mono font-bold">{{ $item->sub_class }}</span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button wire:click="edit({{ $item->id }})" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">Edit</button>
                        <button wire:click="delete({{ $item->id }})" wire:confirm="Hapus kelas ini?" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-medium">Hapus</button>
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
                {{ $isEdit ? 'Edit Kelas' : 'Buat Kelas Baru' }}
            </h3>
            
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <div>
                    <label class="text-sm dark:text-gray-300">Tingkat (Name)</label>
                    <input wire:model="name" type="text" placeholder="Contoh: Awwaliyah" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-pesantren-500">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm dark:text-gray-300">Kelas (Angka)</label>
                        <input wire:model="class" type="text" placeholder="1" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-pesantren-500">
                        @error('class') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="text-sm dark:text-gray-300">Sub Kelas (Huruf)</label>
                        <input wire:model="sub_class" type="text" placeholder="A" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-pesantren-500">
                        @error('sub_class') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-500 hover:text-gray-700 dark:text-gray-400">Batal</button>
                    <button type="submit" class="bg-pesantren-500 hover:bg-pesantren-600 text-white px-4 py-2 rounded-lg">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>