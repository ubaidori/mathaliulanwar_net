<div x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelas Diniyah</h2>
            <p class="text-sm text-gray-500">Master data kelas pendidikan.</p>
        </div>
        <button wire:click="create" 
                class="bg-emerald-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-emerald-600 cursor-pointer">
            + Tambah Kelas
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Tingkat (Name)</th>
                    <th class="px-6 py-4">Kelas</th>
                    <th class="px-6 py-4">Sub Kelas</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($classes as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $item->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $item->class }}</td>
                    <td class="px-6 py-4 text-gray-600">
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs font-mono font-bold">{{ $item->sub_class }}</span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button wire:click="edit({{ $item->id }})" class="text-blue-500 hover:text-blue-700 p-2 rounded-full hover:bg-blue-100 transition duration-150 cursor-pointer">
                            <svg xmlns="www.w3.org" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>

                        <button wire:click="delete({{ $item->id }})" wire:confirm="Hapus kelas ini?" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition duration-150 cursor-pointer">
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

    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
         style="display: none;">
        
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl p-6 border border-gray-200">
            <h3 class="text-xl font-bold mb-4 text-gray-800">
                {{ $isEdit ? 'Edit Kelas' : 'Buat Kelas Baru' }}
            </h3>
            
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <div>
                    <label class="text-sm">Tingkat (Name)</label>
                    <input wire:model="name" type="text" placeholder="Contoh: Awwaliyah" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Kelas (Angka)</label>
                        <input wire:model="class" type="text" placeholder="1" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                        @error('class') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="text-sm">Sub Kelas (Huruf)</label>
                        <input wire:model="sub_class" type="text" placeholder="A" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                        @error('sub_class') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-500 text-gray-200 border border-gray-300 rounded-lg hover:text-gray-300 hover:bg-gray-600 cursor-pointer">Batal</button>
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg cursor-pointer">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>